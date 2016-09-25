<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Validator;
use Response;
class SupplierController extends Controller
{
    public function index()
    {
    	$suppliers = DB::connection('mysql')
                        ->table('supplier')->get();
    	return view('supplier.index',compact('suppliers'));
    }

    public function store(Request $req)
    {
    	$validate = Validator::make($req->all(), Supplier::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $category = Supplier::create($req->all());
        if($category)        
        	return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function supplier_list()
    {
    	$list = Supplier::get();
    	return $list;
    }
}
