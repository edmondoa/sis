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
    
    public function index()
    {
    	if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
    	return view('journals.index');
    }

    public function journal_list()
    {
    	if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
    	$approvals = Approval::with('approvalable','approval_type')->where('user_id',Auth::user()->user_id)->get();
    	return $approvals;
    }
}
