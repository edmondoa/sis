<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use Validator;
use Response;
use App\Models\Cluster;
use Redirect;
class BranchController extends Controller
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
      return view('branch.index');
    }

    public function create()
    {
      if(!Core::setConnection())
      {
       return redirect()->intended('login');
      }
      $clusters = Cluster::get();
      return view('branch.create',compact('clusters'));
    }


    public function branch_list(Request $req)
    {
    	Core::setConnection();
      $start = $req->offset;
      $limit = $req->limit;
      $search = @$req->searchStr;
      $sql =  Branch::with('cluster')->whereRaw("branch_name LIKE ('%".$search."%')");
      $total = $sql->count();
      $list = $sql->skip($start)->take($limit)->get();

      $rows = array_map(function($row){
        $action = "<div class='text-center'><a data-id='".$row['branch_id']."' href='javascript:void(0)' title='Edit Branch' class='branch-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
        $action .= "</div>";
        return [
            'action' => $action,
            'branch_name' => $row['branch_name'],
            'cluster_name' => $row['cluster']['cluster_name'],
            'status' => $row['status'],
            'lock' => ($row['lock'] == 1) ? 'True' : 'False',
            'suspended' => ($row['suspended'] == 1) ? 'True' : 'False'
          ];
      },$list->toArray());
      return response()->json(['total'=>$total,'rows'=>$rows]);
    }

    public function store(Request $req)
    {
    	   Core::setConnection();
        $inputs = $req->all();
    	  $validate = Validator::make($inputs, Branch::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        $branch = Branch::create($inputs);
        if($branch)
        	return Response::json(['status'=>true,'message' => "Successfully created!"]);

        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function edit($id)
    {
        Core::setConnection();
        $branch = Branch::find($id);
        $clusters = Cluster::get();
        return view('branch.edit',compact('branch','clusters'));
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
            $jdata['message'] = "Successfully updated!";

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
