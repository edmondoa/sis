<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use App\User;
use Config;
use App\Libraries\Core;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
       if(!Session::has('dbname')){
         Session::put('dbname','domain1');     
       }
       Core::setConnection(); 
       if(!Auth::check())
           return Redirect::to('login'); 
        return view('index');
    }
}
