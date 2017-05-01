<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use Illuminate\Http\Request;
use App\Libraries\Model;
use App\Http\Requests;
use App\Libraries\Core;
use Validator;
use Response;
use Redirect;
class ProductGroupController extends Controller
{
    //
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
        return view('productgroup.index');
    }

    public function create()
    {
      if(!Core::setConnection())
        {
            return redirect()->intended('login');
        }
        return view('productgroup.create');
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
        	return Response::json(['status'=>true,'message' => "Successfully created!"]);

        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function group_list(Request $req)
    {
    	Core::setConnection();
      $start = $req->offset;
      $limit = $req->limit;
      $filter = @$req->searchStr;
      $sort = ($req->sort) ? $req->sort : 'group_name';
      $order = @$req->order || 'asc';
      $sql =  ProductGroup::whereRaw("group_name LIKE ('%".$filter."%')");
      $total = $sql->count();
      $list = $sql->orderBy($sort,$order)->skip($start)->take($limit)->get();
      $rows = array_map(function($row){
        $action = "<div class='text-center'><a data-id='".$row['group_id']."' href='javascript:void(0)' title='Edit Group' class='group-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
        $action .= "</div>";
        return [
            'action' => $action,
            'group_name' => $row['group_name'],
            'notes'=> $row['notes']
        ];
      },$list->toArray());

      return response()->json(['rows'=>$rows,'total'=>$total]);
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
            $jdata['message'] = "Successfully updated!";

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
