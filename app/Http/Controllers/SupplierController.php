<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Category;
use App\Models\SupplierCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Validator;
use Response;
class SupplierController extends Controller
{
    public function index()
    {
    	
        $categories = Category::get();                
    	return view('supplier.index',compact('categories'));
    }

    public function store(Request $req)
    {
    	$validate = Validator::make($req->all(), Supplier::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        DB::beginTransaction();
        $supplier = Supplier::create($req->all());
        if($supplier) {       
            $sup_category = new SupplierCategory;
            $sup_category->category_id = $req->category_id;
            $sup_category->supplier_id = $req->supplier_id;
            $sup_category->save();
            if($sup_category){
                DB::commit();
                return Response::json(['status'=>true,'message' => "Successfuly created!"]);
            }
        	
        }
        DB::rollback();
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function supplier_list()
    {
    	$list = Supplier::get();
    	return $list;
    }

    protected function rules($category_id)
    {
        return ['supplier_name' => 'required|unique:supplier,supplier_name,NULL,id,category_id,' . $category_id];

    }
}
