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
        $sys_category = DB::connection('mysql')
                        ->table('category')->get();
        return view('category.index',compact('sys_category'));
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
        	return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function category_list()
    {
    	Core::setConnection();
        $list = Category::get();
    	return $list;
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
            $jdata['message'] = "Successfuly updated!";
     
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
