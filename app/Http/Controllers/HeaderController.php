<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use Auth;
use DB;
class HeaderController extends Controller
{
    
    public function task()
    {
    	Core::setConnection();
    	if(Auth::user()->level_id > 2)
    	{
    		$sql = Approval::with('approvalable','branch','approval_type')->where('status','PENDING')->get();
    		return $sql;
    	 }
    	return [];
    }
}
