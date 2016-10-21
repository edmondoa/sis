<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Branch;
use App\Models\Product;
use App\Models\StockinFloat;
use App\Models\StockItem;
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
    	$input['post_date'] = date("Y-m-d");
    	
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

    public function stockFloatSave(Request $req)
    {
    	$rows = count($req->quantity);
    	
    	$stockin = Session::get('stockinFloat');    	
    	
    	$stockin['arrive_date'] = date("Y-m-d",strtotime($stockin['arrive_date']));
    	$stockin['doc_date'] = date("Y-m-d",strtotime($stockin['doc_date']));
    	
    	$stock = StockinFloat::create($stockin);
    	for($i = 0; $i < $rows; $i++)
    	{    		
    		$item = [
    			'product_id' => $req->prod_id[$i], 
    			'quantity'	 => $req->quantity[$i], 	
    			'cost_price' => $req->costprice[$i],
    			'stockin_float_id' => $stock->stockin_float_id
    		];
    		StockItem::create($item );
    	}
    	Session::forget('prodlist');
    	Session::forget('stockinFloat');
    	return Response::json(['status'=>true,'message' => "Successfuly save!"]);
     
    }

    public function removeItems($key)
    {
    	$prodlist = (Session::has('prodlist'))?Session::get('prodlist'):[];
    	unset($prodlist[$key]);
    	array_values($prodlist);
    	Session::put('prodlist',$prodlist);
    	return Response::json(['status'=>true,'message' => "Successfuly remove!"]);
    }

    
}
