<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
use App\Models\Cluster;
class BranchController extends Controller
{
    
    public function index()
    {
        $clusters = Cluster::get();
    	return view('branch.index',compact('clusters'));
    }


    public function branch_list()
    {
    	return Branch::with('cluster')->get();
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
