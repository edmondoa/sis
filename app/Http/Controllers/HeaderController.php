<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use Auth;
use DB;
use Redirect;
class HeaderController extends Controller
{
    
    public function task()
    {
    	        
        Core::setConnection() ;
    	if(Auth::user()->level_id > 2){
           
    		Core::setConnection();
            $approvals = Approval::with('approvalable','branch','approval_type','user')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('status','PENDING')->get();
            $approvals = array_map(function($app){

            return [
                'post_date'=> $app['post_date'],
                'branch_name'=>$app['branch']['branch_name'],
                'approval_type' => $app['approval_type']['approval'],
                'user' => $app['user']['firstname'].' '.$app['user']['lastname'],
                'status' => $app['status']
            ];
        },$approvals->toArray() ) ;                   
       
            $tranfers = Transfer::with('approval','branch_orig','user')
                        ->where('recv_branch_id',Auth::user()->branch_id)
                        ->where('status','APPROVED')->get();
            
            $tranfers = array_map(function($tran){

                return [
                    'post_date'=> $tran['approval']['post_date'],
                    'branch_name'=>$tran['branch_orig']['branch_name'],
                    'approval_type' => 'STOCK TRANSFER',
                    'user' => $tran['user']['firstname'].' '.$tran['user']['lastname'],
                    'status' => $tran['status']
                ];
            },$tranfers->toArray() ) ;             
            return array_merge($tranfers,$approvals); 
    	 }
    	return [];
    }
}
