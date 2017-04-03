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

    	return view('clusters.index');
    }

    public function create()
    {
      if(!Core::setConnection())
      {
       return redirect()->intended('login');
      }
      return view("clusters.create");
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

    public function cluster_list(Request $req)
    {
    	Core::setConnection();
      $start = $req->offset;
      $limit = $req->limit;
      $search = @$req->searchStr;
      $list = Cluster::whereRaw("cluster_name LIKE ('%".$search."%')")->skip($start)->take($limit)->get();
      $total = Cluster::count();
      $rows = array_map(function($row){
        $action = "<div class='text-center'><a data-id='".$row['cluster_id']."' href='javascript:void(0)' title='Edit Cluster' class='cluster-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
        if($row['count_branch'] == 0){
            $action .= "<a data-id='".$row['cluster_id']."' href='javascript:void(0)' title='Delete Cluster' class='cluster-delete ml-5 text-danger'><i class='fa fa-times-circle' aria-hidden='true'></i></i></a>";
        }
        $action .= "</div>";
        return [
            'action' => $action,
            'cluster_name' => $row['cluster_name'],
            'count_branch'=> $row['count_branch']
          ];
      },$list->toArray());
      return response()->json(['total'=>$total,'rows'=>$rows]);

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
