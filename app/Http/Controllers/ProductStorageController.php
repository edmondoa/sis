<?php

namespace App\Http\Controllers;

use App\Models\ProductStorage;
use App\Models\Branch;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
use Exception;
class ProductStorageController extends Controller
{
    public function index()
    {
    	$branches = Branch::get();
    	return view('productstorage.index',compact('branches'));
    }

    public function store(Request $req)
    {
    	$validate = Validator::make($req->all(), ProductStorage::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        try{
        	 $storage = ProductStorage::create($req->all());
        	if($storage)        
        		return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        
        }catch(Exception $e)
        {
        	return Response::json(['status'=>false,'message' => ["Error occured, please check youre storage if duplicate!"]]);
        }
       	
        
    }

    public function storage_list()
    {
    	$list = ProductStorage::with('branch')->get();
    	return $list;
    }
}
