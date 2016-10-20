<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Branch;
use App\Models\Product;
use App\Models\StockinFloat;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
use Auth;
use Session;
class StockinController extends Controller
{
    public function index()
    {
    	$suppliers = Supplier::get();
    	$branches = Branch::get();
    	return view('stockin.index',compact('suppliers','branches'));
    }

    public function stockFloat(Request $req)
    {
    	$input = $req->all();     		
    	$input['user_id'] = Auth::user()->user_id;
    	$input['type'] = "PURCHASE";
    	$input['encode_date'] = date("Y-m-d");
    	
    	$validate = Validator::make($input, StockinFloat::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        Session::put('stockinFloat',$input);

        //$stockinFloat = //StockinFloat::create($input);
        //if($stockinFloat)        
        return Response::json(['status'=>true,'message' => "Successfuly added!",'stockin'=>$input]);
        
        //return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);	
    }

    public function stockFloatItems(Request $req)
    {
    	$prodlist = (Session::has('prodlist'))?Session::get('prodlist'):[];
    	
    	foreach ($req->ids as $id) {
    		$prod = Product::find($id);    		
    		array_push($prodlist,$prod);
    	}    	
    	Session::put('prodlist',$prodlist);
    	$jdata['prodlist'] =$prodlist;
    	return $jdata;
    }

    public function stockinList()
    {
    	$jdata['prodlist'] = (Session::has('prodlist'))?Session::get('prodlist'):[];
    	$jdata['stockin'] = (Session::has('stockinFloat'))?Session::get('stockinFloat'):[];
    	return $jdata;
    }

    public function cancel()
    {
    	Session::forget('prodlist');
    	Session::forget('stockinFloat');
    	$jdata['prodlist'] = [];
    	$jdata['stockin'] = [];
    	$jdata['status'] = true;
    	$jdata['message'] ="Successfuly cancelled!";
    	return $jdata;
    }

    
}
