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
use Redirect;
class ProductStorageController extends Controller
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
      $branches = Branch::get();
    	return view('productstorage.index');
    }

    public function create()
    {
      if(!Core::setConnection())
      {
        return redirect()->intended('login');
      }
      $branches = Branch::get();
      	return view('productstorage.create',compact('branches'));
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
        		return Response::json(['status'=>true,'message' => "Successfully created!"]);

        }catch(Exception $e)
        {
        	return Response::json(['status'=>false,'message' => ["Error occured, please check youre storage if duplicate!"]]);
        }


    }

    public function storage_list(Request $req)
    {
    	Core::setConnection();
        $list = ProductStorage::with('branch')->get();
        $start = $req->offset;
        $limit = $req->limit;
        $filter = @$req->searchStr;
        $sort = ($req->sort) ? $req->sort : 'storage_name';
        $order = @$req->order || 'asc';
        $sql =  ProductStorage::with('branch')
                      ->leftJoin('branch','product_storage.branch_id','branch.branch_id')
                      ->whereRaw("product_storage.storage_name LIKE ('%".$filter."%') OR branch.branch_name LIKE ('%".$filter."%')")
                      ->select("product_storage.*");
        $total = $sql->count();
        $list = $sql->orderBy($sort,$order)->skip($start)->take($limit)->get();
        $rows = array_map(function($row){
          $action = "<div class='text-center'><a data-id='".$row['storage_id']."' href='javascript:void(0)' title='Edit Storage' class='group-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
          $action .= "</div>";
          return [
              'action' => $action,
              'storage_name' => $row['storage_name'],
              'branch_name'=> $row['branch']['branch_name']
          ];
        },$list->toArray());

        return response()->json(['rows'=>$rows,'total'=>$total]);
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
            $jdata['message'] = "Successfully updated!";

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
