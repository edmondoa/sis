<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;

class MemoCreditsController extends Controller
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
    	return view('memo_credit.index');
    }
    public function create()
    {
    	if(!Core::setConnection())
        {
            return redirect()->intended('login');
        }  
    	return view('memo_credit.create');
    }

    public function credit_list()
    {

    }
}
