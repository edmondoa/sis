<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Stockin;
use App\Models\Setting;
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

    public function update($status,$id)
    {
    	$approval = Approval::with('approvalable')->find($id);
    	$approval->status = $status;
    	$approval->approver_user_id = Auth::user()->user_id;
    	$approval->approve_date =  Setting::first()->pluck('post_date')[0];
    	if($approval->save())
    	{
            if($status == 'APPROVED')
    		      $approval->approvalable->series_id = $this->series_id($approval->approvalable->branch_id);
    		$approval->approvalable->status = $status;
    		
    		if($approval->approvalable->save())
    		{
    			return Response::json(['status'=>true,'message' => "Successfuly ".strtolower($status)."!"]);
        
    		}
    	}
    	return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);	
    	
    }



    private function series_id($branch_id)
    {
    	$max = Stockin::where('branch_id',$branch_id)->max('series_id');
    	return (is_null($max)) ? 1 : $max + 1;
    }
}
