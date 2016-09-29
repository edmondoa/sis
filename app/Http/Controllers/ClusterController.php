<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Cluster;
use Validator;
use Response;
class ClusterController extends Controller
{
    public function index()
    {
        $clusters = Cluster::get();
    	return view('clusters.index',compact('clusters'));
    }

    public function store(Request $req)
    {
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
    	$list = Cluster::get();
    	return $list;
    }
}
