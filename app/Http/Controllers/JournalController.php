<?php

namespace App\Http\Controllers;
use App\Models\Approval;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Libraries\Core;
use Redirect;
class JournalController extends Controller
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
    	return view('journals.index');
    }

    public function journal_list()
    {
    	Core::setConnection();
    	$approvals = Approval::with('approvalable','approval_type')->where('user_id',Auth::user()->user_id)->get();
    	return $approvals;
    }
}
