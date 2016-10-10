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

    public function edit($id)
    {
        $group = ProductGroup::find($id);
        return view('productgroup.edit',compact('group'));
    }

    public function update(Request $request,$id)
    {
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
