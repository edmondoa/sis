<?php

namespace App\Http\Controllers;

use App\models\ProductGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
class ProductGroupController extends Controller
{
    //

    public function index()
    {
    	return view('productgroup.index');
    }

    public function store(Request $req)
    {
    	$validate = Validator::make($req->all(), ProductGroup::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $group = ProductGroup::create($req->all());
        if($group)        
        	return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function group_list()
    {
    	$list = ProductGroup::get();
    	return $list;
    }
}
