<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Branch;
use App\Libraries\Core;
use Validator;
use Response;
use Redirect;
use Auth;
class PromoController extends Controller
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

    return view('promo.index');
  }

  public function create()
  {
    if(!Core::setConnection())
    {
     return redirect()->intended('login');
    }
    if(Auth::user()->level_id > 2){
      $products =  Product::orderBy('product_name','ASC')->get();
    }else {
        $products =  Product::whereRaw('product_id IN (SELECT DISTINCT(product_id) FROM stockin_item si
        LEFT JOIN `stockin` s ON si.stockin_id = s.stockin_id
        WHERE s.branch_id = '.Auth::user()->branch_id.')')->orderBy('product_name','ASC')->get();
    }
    $branches = Branch::get();
    return view("promo.create",compact('products','branches'));
  }
}
