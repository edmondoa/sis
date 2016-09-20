<?php

namespace App\Http\Controllers;

use App\Models\AccountLevel;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;
class AccountLevelController extends Controller
{
    //
    public function index()
    {
    	return view('accounts.account_level');
    }

    public function store(Request $req)
    {
    	$inputs = $req->all();    	
    	$validate = Validator::make($inputs, AccountLevel::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
       
        $account_level = AccountLevel::create($inputs);
        if($account_level)        
        	return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function level_list()
    {
    	return AccountLevel::get();
    }
}
