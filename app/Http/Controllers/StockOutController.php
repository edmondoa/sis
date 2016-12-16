<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Setting;
use App\Models\Branch;
use App\Models\Product;
use App\Models\StockOut;
use App\Models\StockOutItem;
use App\Models\Approval;
use App\Models\StockItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
use Auth;
use Session;
use DB;

class StockOutController extends Controller
{
    
    public function index()
    {
    	$suppliers = Supplier::get();
    	$branches = Branch::get();
    	return view('stockout.index',compact('suppliers','branches'));
    }

    public function stockoutFloat(Request $req)
    {
    	$input = $req->all();   	
    	$input['status'] = 'ONGOING';
    	$input['user_id'] = Auth::user()->user_id;
    	$validate = Validator::make($input, StockOut::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        StockOut::create($input);
        Session::put('stockoutFloat',$input);

        //$stockinFloat = //StockinFloat::create($input);
        //if($stockinFloat)        
        return Response::json(['status'=>true,'message' => "Successfuly added!",'stockin'=>$input]);
    }

    public function stockoutList()
    {
    	$stockout = StockOut::with('items')->where('user_id',Auth::user()->user_id)
    						->where('status','ONGOING')
    						->orderBy('stockout_id', 'desc')->first();
    					
    	$jdata['prodlist'] = (!is_null($stockout->items)) ? $stockout->items : [];;

    	$jdata['stockout'] = (!is_null($stockout)) ? $stockout : [];;
    	return $jdata;
    }

    public function search()
    {
    	 $src ="stockout";
        return view('products.search',compact('src'));
    }

    public function postSingleSearch(Request $req)
    {
    	$sup = $req->supplier_id;
    	$branch = $req->branch_id;

        $search = trim($req->str);
        
       
       	$sql = "
       			SELECT p.*,c.category_code FROM product p
                LEFT JOIN category c ON p.category_id = c.category_id
                LEFT JOIN supplier_category sc ON c.category_id = sc.category_id
                WHERE sc.supplier_id = $sup
                AND (product_code = '".$search."' OR 
                  barcode = '".$search."')  AND p.suspended = 0  AND
       		 	p.product_id IN (
					SELECT DISTINCT(product_id) FROM stockin_item si
					LEFT JOIN `stockin` s ON si.stockin_id = s.stockin_id
					WHERE s.branch_id = $branch AND s.supplier_id = $sup
				) ";		
        
        $products = DB::select($sql);

       
        $products = array_map(function($product) use($branch){
        	  	return [
        		'available' =>StockOut::available($product->product_id,$branch),
        		'product_id' => $product->product_id,
        		'product_code' =>$product->product_code,
        		'category_code' =>$product->category_code,
        		'product_name'  =>$product->product_name,
        		'barcode'  =>$product->barcode,
        		'cost_price' =>$product->cost_price,
        	];
        }, $products );
        if(count($products) > 0){            
            return Response::json(['status'=>true,'products'=>$products]);
        }
        return Response::json(['status'=>false,'products'=>[]]);
    }
    public function postSearch(Request $req)
    {
    	$sup = $req->supplier_id;
    	$branch = $req->branch_id;

        $search = $req->str;
        if($search =='%')
            $search ="";
       
       	$sql = "
       			SELECT p.*,c.category_code FROM product p
                LEFT JOIN category c ON p.category_id = c.category_id
                LEFT JOIN supplier_category sc ON c.category_id = sc.category_id
                WHERE sc.supplier_id = $sup
                AND (product_code LIKE ('%".$search."%') OR 
                  barcode LIKE ('%".$search."%') OR product_name LIKE ('%".$search."%') )
                  AND p.suspended = 0  AND
       		 	p.product_id IN (
					SELECT DISTINCT(product_id) FROM stockin_item si
					LEFT JOIN `stockin` s ON si.stockin_id = s.stockin_id
					WHERE s.branch_id = $branch AND s.supplier_id = $sup
				) LIMIT 15";		
        
        $products = DB::select($sql);

       
        $products = array_map(function($product) use($branch){
        	  	return [
        		'available' =>StockOut::available($product->product_id,$branch),
        		'product_id' => $product->product_id,
        		'product_code' =>$product->product_code,
        		'category_code' =>$product->category_code,
        		'product_name'  =>$product->product_name,
        		'barcode'  =>$product->barcode,
        		'cost_price' =>$product->cost_price,
        	];
        }, $products );
        if(count($products) > 0){            
            return Response::json(['status'=>true,'products'=>$products]);
        }
        return Response::json(['status'=>false,'products'=>[]]); 
    }

    public function saveItems(Request $req)
    {
    	$available = StockOut::available($req->id,$req->branch_id);
    	if($available <= 0)
    	{
    		return Response::json(['status' => false, 'message' =>["Already out of stock"]]);
    	}else if($available < $req->qty)
    	{
    		return Response::json(['status' => false, 'message' =>["Out of range. There are only ".$available." stocks available"]]);
    	}

    	$stockout_item = new StockOutItem;
    	$stockout_item->product_id = $req->id;
        $stockout_item->quantity = $req->qty;
        $stockout_item->stockout_id = $req->stockout_id;
        $stockout_item->cost_price = $req->costprice;
        if($stockout_item->save())
        	return Response::json(['status' => true, 'message' =>["Item are now book"]]);

        return Response::json(['status' => false, 'message' =>["Error"]]);
    }
}
