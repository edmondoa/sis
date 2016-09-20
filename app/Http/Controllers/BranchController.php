<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
class BranchController extends Controller
{
    
    public function index()
    {
    	return view('branch.index');
    }


    public function branch_list()
    {
    	return Branch::get();
    }

    public function store(Request $req)
    {
    	$inputs = $req->all();
    	$inputs['tran_date'] = date('Y-m-d');
    	$validate = Validator::make($inputs, Branch::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
       
        $branch = Branch::create($inputs);
        if($branch)        
        	return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }
}
