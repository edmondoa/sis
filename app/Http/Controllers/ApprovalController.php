<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Stockin;
use App\Models\AdjustIn;
use App\Models\StockOut;
use App\Models\Transfer;
use App\Models\Setting;
use App\Models\ProductBinCard;
use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use Auth;
use Response;
use Redirect;
class ApprovalController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }
    public function index()
    {
        if(!Core::setConnection())
        {
         return redirect()->intended('login');
        }
    	return view('approvals.index');
    }

    public function approve_list()
    {
        Core::setConnection();
    	$approvals = Approval::with('approvalable','branch','approval_type','user')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('status','PENDING')->get();

        $approvals = array_map(function($app){

            return [
                'post_date'=> $app['post_date'],
                'branch_name'=>$app['branch']['branch_name'],
                'approval_type' => $app['approval_type']['approval'],
                'approvalable_id' => $app['approvalable_id'],
                'approval_id' => $app['approval_id'],
                'user' => $app['user']['firstname'].' '.$app['user']['lastname'],
                'status' => $app['status']
            ];
        },$approvals->toArray() ) ;

        $tranfers = Transfer::with('approval','branch_transfer','user')
                    ->where('recv_branch_id',Auth::user()->branch_id)
                    ->where('status','APPROVED')->get();

        $tranfers = array_map(function($tran){

            return [
                'post_date'=> $tran['approval']['post_date'],
                'branch_name'=>$tran['branch_transfer']['branch_name'],
                'approval_type' => 'STOCK TRANSFER',
                'approval_id' => $app['transfer_id'],
                'user' => $tran['user']['firstname'].' '.$tran['user']['lastname'],
                'status' => $tran['status']
            ];
        },$tranfers->toArray() ) ;
        return array_merge($tranfers,$approvals);
    }

    public function update(Request $request,$status,$id)
    {
    	Core::setConnection();
        $approval = Approval::with('approvalable')->find($id);
        $other_detail = $this->format_data($approval->approval_type_id);
    	$approval->status = $status;
        if($status != 'APPROVED')
            $approval->notes = $request->note;
    	$approval->approver_user_id = Auth::user()->user_id;
    	$approval->approve_date =  Setting::first()->pluck('post_date')[0];

        if($approval->save())
    	{
            if(($status == 'APPROVED' && $other_detail['type']!='TRO') || $status == 'RECEIVED' )
    		    $approval->approvalable->series_id = $this->series_id($approval->approval_type_id, $approval->approvalable->branch_id);
    		$approval->approvalable->status = $status;

    		if($approval->approvalable->save())
    		{
                if($status == 'APPROVED' && $other_detail['type']!='TRO')
                    ProductBinCard::insert($approval->approvalable->items,$other_detail['reference'],$other_detail['type'],$other_detail['negative']);
    			if($status == 'RECEIVED'){
                    ProductBinCard::insert($approval->approvalable->items,$other_detail['reference'],$other_detail['type'],$other_detail['negative']);
                }
                return Response::json(['status'=>true,'message' => "Successfully ".strtolower($status)."!"]);

    		}
    	}
    	return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);

    }


    public function notes()
    {
        Core::setConnection();
        return view('approvals.note');
    }



    private function series_id($type,$branch_id)
    {
    	Core::setConnection();
        if($type==1)
            $max = Stockin::where('branch_id',$branch_id)->max('series_id');
    	 else if($type==2)
            $max = StockOut::where('branch_id',$branch_id)->max('series_id');
      else if($type==4)
            $max = AdjustIn::where('branch_id',$branch_id)->max('series_id');      

        return (is_null($max)) ? 1 : $max + 1;
    }

    private function format_data($type)
    {
        $data=[];
        if($type == 1)        {
            $data['reference'] = 'stockin_id';
            $data['type'] = 'STI';
            $data['negative'] = 0;
        }else if($type==2){
            $data['reference'] = 'stockout_id';
            $data['type'] = 'STO';
            $data['negative'] = 1;
        }else if($type==3){
            $data['reference'] = 'transfer_id';
            $data['type'] = 'TRO';
            $data['negative'] = 0;
        }else if($type==4){
            $data['reference'] = 'stock_adj_in_id';
            $data['type'] = 'ADI';
            $data['negative'] = 0;
        }
        return $data;
    }
}
