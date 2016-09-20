<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
class ProductController extends Controller
{
    
    public function index()
    {
    	$category = Category::get();
    	return view('products.index',compact('category'));
    }

    public function store(Request $req)
    {
    	$inputs = $req->all();
    	$inputs['tran_date'] = date('Y-m-d');
    	$validate = Validator::make($inputs, Product::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
       
        $product = Product::create($inputs);
        if($product)        
        	return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function product_list()
    {
    	return Product::with('category')->get();
    }
}
