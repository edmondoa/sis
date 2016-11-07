<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use Illuminate\Http\Request;

use App\Http\Requests;

class ApprovalController extends Controller
{
    
    public function index()
    {
    	return view('approvals.index');
    }

    public function approve_list()
    {
    	return Approval::with('branch','approval_type','user')->where('status','PENDING')->get();
    }
}
