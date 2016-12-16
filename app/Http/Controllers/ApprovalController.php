<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Stockin;
use App\Models\StockOut;
use App\Models\Setting;
use App\Models\ProductBinCard;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Response;

class ApprovalController extends Controller
{
    
    public function index()
    {
    	return view('approvals.index');
    }

    public function approve_list()
    {
    	return Approval::with('approvalable','branch','approval_type','user')->where('status','PENDING')->get();
    }

    public function update(Request $request,$status,$id)
    {
    	$approval = Approval::with('approvalable')->find($id);
        $other_detail = $this->format_data($approval->approval_type_id);
    	$approval->status = $status;
        if($status != 'APPROVED')
            $approval->notes = $request->note;
    	$approval->approver_user_id = Auth::user()->user_id;
    	$approval->approve_date =  Setting::first()->pluck('post_date')[0];
    	
        if($approval->save())
    	{
            if($status == 'APPROVED')
    		    $approval->approvalable->series_id = $this->series_id($approval->approval_type_id, $approval->approvalable->branch_id);
    		$approval->approvalable->status = $status;
    		
    		if($approval->approvalable->save())
    		{
                if($status == 'APPROVED')
                    ProductBinCard::insert($approval->approvalable->items,$other_detail['reference'],$other_detail['type'],$other_detail['negative']);
    			return Response::json(['status'=>true,'message' => "Successfuly ".strtolower($status)."!"]);
        
    		}
    	}
    	return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);	
    	
    }


    public function notes()
    {
        return view('approvals.note');
    }



    private function series_id($type,$branch_id)
    {
    	if($type==1)
            $max = Stockin::where('branch_id',$branch_id)->max('series_id');
    	else if($type==2)
            $max = StockOut::where('branch_id',$branch_id)->max('series_id');
        return (is_null($max)) ? 1 : $max + 1;
    }

    private function format_data($type)
    {
        if($type == 1)        {
            $data['reference'] = 'stock_id';
            $data['type'] = 'STI';
            $data['negative'] = 0;
        }else if($type==2){
            $data['reference'] = 'stockout_id';
            $data['type'] = 'STO';
            $data['negative'] = 1;
        }
        return $data;
    }
}
