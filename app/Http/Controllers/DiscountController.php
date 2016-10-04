<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\AccountLevel;
use App\Models\Discount;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
use Exception;
class DiscountController extends Controller
{
    public function index()
    {
    	$categorys = Category::get();
    	$acc_level = AccountLevel::get();
    	return view('discounting.index',compact('categorys','acc_level'));
    }

    public function store(Request $req)
    {
    	$inputs = $req->all();    	
    	$validate = Validator::make($inputs, Discount::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        try{
           $discount = Discount::create($inputs);
        if($discount)        
            return Response::json(['status'=>true,'message' => "Successfuly created!"]); 
        }catch(Exception $e){
              return Response::json(['status'=>false,'message' => ["Error in saving, Please check this discount combination may already exist!"]]);
        }
        
        
      
    }

    public function discount_list()
    {
    	return Discount::with(['category','account_level'])->get();
    }
}
