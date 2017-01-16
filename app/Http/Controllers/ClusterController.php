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
    public function index()
    {
        if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
        $clusters = Cluster::get();
    	return view('clusters.index',compact('clusters'));
    }

    public function store(Request $req)
    {
    	if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
        $validate = Validator::make($req->all(), Cluster::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $cluster = Cluster::create($req->all());
        if($cluster)        
        	return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function cluster_list()
    {
    	if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
        $list = Cluster::get();
    	return $list;
    }

    public function edit($id)
    {
        if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
        $cluster = Cluster::find($id);        
        return view('clusters.edit',compact('cluster'));
    }

    public function update(Request $request,$id)
    {
        if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
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
            $jdata['message'] = "Successfuly updated!";
     
        }
        return $jdata;
    }

    public function destroy($id)
    {
        if(!Core::setConnection()){           
            return Redirect::to("/login");
        }
        $jdata['status'] = false;
        $jdata['message'] = "Error in updating, Please contact the administrator";
        
        
        $cluster = Cluster::find($id);      
        if($cluster->delete())
        {
            $jdata['status'] = true;
            $jdata['message'] = "Successfuly deleted!";
     
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
