<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\AccountLevel;
use App\Models\Discount;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use Validator;
use Response;
use Exception;
use Redirect;
class DiscountController extends Controller
{
    public function index()
    {
    	if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
        $categorys = Category::get();
    	$acc_level = AccountLevel::get();
    	return view('discounting.index',compact('categorys','acc_level'));
    }

    public function store(Request $req)
    {
    	if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
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
    	if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
        return Discount::with(['category','account_level'])->get();
    }
}
