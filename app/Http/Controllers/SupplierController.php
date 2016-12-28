<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Category;
use App\Models\SupplierCategory;
use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use DB;
use Validator;
use Response;
class SupplierController extends Controller
{
    public function index()
    {
    	Core::setConnection();
        
        $categories = Category::get();                
    	return view('supplier.index',compact('categories'));
    }

    public function store(Request $req)
    {
    	Core::setConnection();
        $validate = Validator::make($req->all(), Supplier::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        
        $supplier = Supplier::create($req->all());
        if($supplier) { 
            return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        }        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function supplier_list()
    {
    	Core::setConnection();
        $list = Supplier::get();
    	return $list;
    }

    public function edit($id)
    {
        Core::setConnection();
        $supplier = Supplier::find($id);
        $mylist = [];
        foreach ($supplier->category as $key) {
            array_push($mylist,$key->pivot->category_id);
        }
       
        $categories = Category::get();
        return view('supplier.edit',compact('supplier','categories','mylist'));
    }

    public function update(Request $request,$id)
    {
        Core::setConnection();
        $jdata['status'] = false;
        $jdata['message'] = "Error in updating, Please contact the administrator";
        
        $validate = Validator::make($request->all(), self::rules($id));
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $supplier = Supplier::find($id);
        $supplier->supplier_name = $request->supplier_name;
        $supplier->contact_person = $request->contact_person;
        $supplier->mobile1_no = $request->mobile1_no;
        $supplier->mobile2_no = $request->mobile2_no;
        $supplier->landline_no = $request->landline_no;
        $supplier->email = $request->email;
        $supplier->notes = $request->notes;
        $supplier->lock = (isset($request->lock))?1:0;
        $supplier->suspended = (isset($request->suspended))?1:0;
        if($supplier->save())
        {
            if(count($request->category) > 0){
                $supplier->category()->detach();            
                foreach ($request->category as $val) {              
                   $supplier->category()->attach($val);              
                }
            }    
            $jdata['status'] = true;
            $jdata['message'] = "Successfuly updated!";
     
        }

       
        return $jdata;
    }

    private function rules($param)
    {
        return [
               'supplier_name' => 'required|unique:supplier,supplier_name,'.$param.',supplier_id',
               'email' => 'email'
            ];
    }
}
