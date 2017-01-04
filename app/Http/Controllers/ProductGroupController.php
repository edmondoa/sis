<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use Illuminate\Http\Request;
use App\Libraries\Model;
use App\Http\Requests;
use App\Libraries\Core;
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
    	Core::setConnection();
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
    	Core::setConnection();
        $list = ProductGroup::get();
    	return $list;
    }

    public function edit($id)
    {
       Core::setConnection();
        $group = ProductGroup::find($id);
        return view('productgroup.edit',compact('group'));
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
        $pgroup = ProductGroup::find($id);
        $pgroup->group_name = $request->group_name;
        $pgroup->notes = $request->notes;
        
        if($pgroup->save())
        {
            $jdata['status'] = true;
            $jdata['message'] = "Successfuly updated!";
     
        }
        return $jdata;
    }

    private function rules($param)
    {
        return [
               'group_name' => 'required|unique:product_group,group_name,'.$param.',group_id'               
            ];
    }
}
