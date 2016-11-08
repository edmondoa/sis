<?php

namespace App\Http\Controllers;
use App\Models\Approval;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class JournalController extends Controller
{
    
    public function index()
    {
    	return view('journals.index');
    }

    public function journal_list()
    {
    	$approvals = Approval::with('approvalable','approval_type')->where('user_id',Auth::user()->user_id)->get();
    	return $approvals;
    }
}
