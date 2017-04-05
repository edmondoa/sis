<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use Validator;
use Response;
use DB;
use Redirect;
class CategoryController extends Controller
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
        return view('category.index');
    }

    public function store(Request $req)
    {
    	Core::setConnection();
        $validate = Validator::make($req->all(), Category::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $category = Category::create($req->all());
        if($category)
        	return Response::json(['status'=>true,'message' => "Successfully created!"]);

        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function create()
    {
      if(!Core::setConnection())
      {
       return redirect()->intended('login');
      }
      $sys_category = DB::connection('mysql');
      return view('category.create',compact('sys_category'));
    }

    public function category_list(Request $req)
    {
    	Core::setConnection();
      $start = $req->offset;
      $limit = $req->limit;
      $search = @$req->searchStr;
      $sql =  Category::whereRaw("category_name LIKE ('%".$search."%') OR category_code LIKE ('%".$search."%')");
      $total = $sql->count();
      $list = $sql->skip($start)->take($limit)->get();

      $rows = array_map(function($row){
        $action = "<div class='text-center'><a data-id='".$row['category_id']."' href='javascript:void(0)' title='Edit Category' class='category-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
        $action .= "<a data-id='".$row['category_id']."' href='javascript:void(0)' title='Delete Category' class='category-delete text-danger ml-5'><i class='fa fa-times-circle' aria-hidden='true'></i></i></a>";
        $action .= "</div>";
        return [
            'action' => $action,
            'category_name' => $row['category_name'],
            'category_code' => $row['category_code'],
            'count_supplier' => $row['count_supplier'],
          ];
      },$list->toArray());
      return response()->json(['total'=>$total,'rows'=>$rows]);
    }

    public function edit($id)
    {
        Core::setConnection();
        $sys_category = DB::connection('mysql')
                        ->table('category')->get();
        $category = Category::find($id);
        return view('category.edit',compact('category','sys_category'));
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
        $category = Category::find($id);
        $category->category_name = $request->category_name;

        if($category->save())
        {
            $jdata['status'] = true;
            $jdata['message'] = "Successfully updated!";

        }
        return $jdata;
    }

    private function rules($param)
    {
        return [
                'category_name' => 'required|unique:category,category_name,'.$param.',category_id',
           ];

    }
}
