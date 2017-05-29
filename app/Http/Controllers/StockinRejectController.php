<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Setting;
use App\Models\Branch;
use App\Models\Product;
use App\Models\StockOut;
use App\Models\StockOutItem;
use App\Models\Approval;
use App\Models\StockItem;
use App\Libraries\Core;
use App\Http\Requests;
use Validator;
use Response;
use Auth;
use Session;
use DB;
use PDF;
use Redirect;
class StockinRejectController extends Controller
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
        $suppliers = Supplier::get();
    	$branches = Branch::get();
    	return view('stockout.index',compact('suppliers','branches'));
    }

}
