<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Cluster;
use App\Libraries\Core;
use Validator;
use Response;
use Redirect;
class ClusterController extends Controller
{
    public function __construct()
    {        
        $this->middleware('web');
    }
    public function index()
    {
        if(!Core::setConnection())
        {
         return redirect()->intended('login');
        }  
        $clusters = Cluster::get();
    	return view('clusters.index',compact('clusters'));
    }

    public function store(Request $req)
    {
    	Core::setConnection();
        $validate = Validator::make($req->all(), Cluster::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $cluster = Cluster::create($req->all());
        if($cluster)        
        	return Response::json(['status'=>true,'message' => "Successfully created!"]);
        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function cluster_list()
    {
    	Core::setConnection();
        $list = Cluster::get();
    	return $list;
    }

    public function edit($id)
    {
        Core::setConnection();
        $cluster = Cluster::find($id);        
        return view('clusters.edit',compact('cluster'));
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
        $cluster = Cluster::find($id);
        $cluster->cluster_name = $request->cluster_name;
        $cluster->notes = $request->notes;
        if($cluster->save())
        {
            $jdata['status'] = true;
            $jdata['message'] = "Successfully updated!";
     
        }
        return $jdata;
    }

    public function destroy($id)
    {
        Core::setConnection();
        $jdata['status'] = false;
        $jdata['message'] = "Error in updating, Please contact the administrator";
        
        
        $cluster = Cluster::find($id);      
        if($cluster->delete())
        {
            $jdata['status'] = true;
            $jdata['message'] = "Successfully deleted!";
     
        }
        return $jdata;
    }

    private function rules($param)
    {
        return [
               'cluster_name' => 'required|unique:cluster,cluster_name,'.$param.',cluster_id'
            ];
    }
}
