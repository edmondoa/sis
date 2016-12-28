<?php

namespace App\Http\Controllers;

use App\Models\ProductStorage;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use Validator;
use Response;
use Exception;
class ProductStorageController extends Controller
{
    public function index()
    {
    	Core::setConnection();
        $branches = Branch::get();
    	return view('productstorage.index',compact('branches'));
    }

    public function store(Request $req)
    {
    	Core::setConnection();
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
    	Core::setConnection();
        $list = ProductStorage::with('branch')->get();
    	return $list;
    }
    public function edit($id)
    {
        Core::setConnection();
        $branches = Branch::get();
        $storage = ProductStorage::find($id);
        return view('productstorage.edit',compact('storage','branches'));
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
        $storage = ProductStorage::find($id);
        $storage->branch_id = $request->branch_id;
        $storage->storage_name = $request->storage_name;
        $storage->notes = $request->notes;
        
        if($storage->save())
        {
            $jdata['status'] = true;
            $jdata['message'] = "Successfuly updated!";
     
        }
        return $jdata;
    }

    private function rules($param)
    {
        return [
               'storage_name' => 'required|unique:product_storage,storage_name,'.$param.',storage_id'               
            ];
    }
}
