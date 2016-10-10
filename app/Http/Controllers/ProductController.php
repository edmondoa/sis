<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\ProductCount;
use App\Models\ProductCountItem;
use App\Models\ProductGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
use DB;
use Auth;
use Session;
class ProductController extends Controller
{
    
    public function index()
    {
    	$category = Category::get();
        $discount = Discount::with('account_level')->get();
        $groups = ProductGroup::get();
    	return view('products.index',compact('category','discount','groups'));
    }

    public function store(Request $req)
    {
    	$inputs = $req->all();
    	$inputs['post_date'] = date('Y-m-d');
        $inputs['user_id'] = Auth::user()->user_id;
    	$validate = Validator::make($inputs, Product::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }        
        $product = Product::create($inputs);
        if($product){        
            return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        }
       
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function product_list()
    {
    	return Product::with('category')->get();
    }
}
