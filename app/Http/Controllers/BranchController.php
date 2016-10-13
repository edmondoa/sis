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

    public function edit($id)
    {
        $branch = Branch::find($id);
        $clusters = Cluster::get();
        return view('branch.edit',compact('branch','clusters'));
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
        $branch = Branch::find($id);
        $branch->business_name = $request->business_name;
        $branch->branch_name = $request->branch_name;
        $branch->cluster_id = $request->cluster_id;
        $branch->tin_no = $request->tin_no;
        $branch->bir_permit_no = $request->bir_permit_no;
        $branch->addressline1 = $request->addressline1;
        $branch->addressline2 = $request->addressline2;
        $branch->lock = (isset($request->lock))?1:0;
        $branch->suspended = (isset($request->suspended))?1:0;
        $branch->notes = $request->notes;
        if($branch->save())
        {
            $jdata['status'] = true;
            $jdata['message'] = "Successfuly updated!";
     
        }
        return $jdata;
    }

    private function rules($param)
    {
        return [                
                'branch_name' => 'required|unique:branch,branch_name,'.$param.',branch_id',
                'business_name' => 'required',
                'addressline1' => 'required'              
            ];
    
    }
}
