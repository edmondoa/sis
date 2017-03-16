<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Branch;
use App\Models\Setting;


use App\Http\Requests;
use Validator;
use Response;
use Auth;
use Session;
use DB;
use PDF;
use Redirect;
class InvoiceController extends Controller
{
    //

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

        $branches = Branch::get();
        $post_date = Setting::first()->pluck('post_date')[0];
        return view('invoice.index',compact('branches','post_date'));

    }
}
