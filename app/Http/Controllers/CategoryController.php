<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
use DB;
class CategoryController extends Controller
{
    
    public function index()
    {
        
    	return view('category.index');
    }

    public function store(Request $req)
    {
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
    	$list = Category::get();
    	return $list;
    }
}
