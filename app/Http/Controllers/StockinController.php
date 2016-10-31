<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Setting;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Stockin;
use App\Models\Approval;
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

    public function search()
    {
        return view('products.search');
    }

    public function stockFloat(Request $req)
    {
    	$input = $req->all();     		
    	$input['user_id'] = Auth::user()->user_id;
    	$input['type'] = "PURCHASE";
    	$input['post_date'] = date("Y-m-d");
    	
    	$validate = Validator::make($input, Stockin::$rules);
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
    	
    	$prod = Product::find($req->id);
        $prod->quantity = $req->qty;
        $prod->cost_price = $req->costprice;
        $prod->total = $req->qty * $req->costprice; 
        		
    	array_unshift($prodlist,$prod);
    	   	
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
    	$rows = count($req->quantity) - 1 ;
    	$post_date = Setting::first()->pluck('post_date')[0];
    	$stockin = Session::get('stockinFloat'); 
    	$approval = Approval::create([
                        'type'=>'STOCKIN',
                        'status' => 'PENDING',
                        'user_id' => Auth::user()->user_id,
                        'post_date' => $post_date]);
        $stockin['arrive_date'] = date("Y-m-d",strtotime($stockin['arrive_date']));
        $stockin['doc_date'] = date("Y-m-d",strtotime($stockin['doc_date']));
        $stockin['approval_id'] = $approval->approval_id;
        $stockin['encode_date'] = $post_date;
    	$stock = Stockin::create($stockin);
        $prodlist = array_reverse(Session::get('prodlist'));
    	foreach($prodlist as $prod)
    	{    		
    		$item = [
    			'product_id' => $prod->product_id, 
    			'quantity'	 => $prod->quantity, 	
    			'cost_price' => $prod->cost_price,    			
    			'stockin_id' => $stock->stockin_id
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
    	$prodlist = array_values($prodlist);
    	Session::put('prodlist',$prodlist);
    	return Response::json(['status'=>true,'message' => "Successfuly remove!"]);
    }

    public function stockFloatUpdate(Request $req)
    {
    	$prodlist = (Session::has('prodlist'))?Session::get('prodlist'):[];
    	$prod = $prodlist[$req->key];
    	$row = $req->row;
    	$prod->$row = $req->value;
    	$prod->total = $prod->quantity * $prod->updated_price; 
    	Session::put('prodlist',$prodlist);
    }

    
}
