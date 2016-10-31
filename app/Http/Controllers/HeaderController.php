<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;
class HeaderController extends Controller
{
    
    public function task()
    {

    	if(Auth::user()->level_id == 5)
    	{
    		$sql = "SELECT a.*,s.doc_no,b.branch_name FROM approval a
    				LEFT JOIN stockin s ON a.approval_id = s.approval_id
    				LEFT JOIN branch b ON s.branch_id = b.branch_id
    				";
    		return DB::select($sql);
    	 }
    	return [];
    }
}
