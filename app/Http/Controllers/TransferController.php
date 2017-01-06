<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Branch;
use App\Models\Transfer;
use App\Models\StockOut;
use App\Models\TransferItem;
use App\Http\Requests;
use Auth;
use Validator;
use Response;
use Session;
use DB;
class TransferController extends Controller
{
    public function index()
    {
    	Core::setConnection();
        $branches = Branch::get();
    	return view('transfer.index',compact('branches'));
    }

    public function transferFloat(Request $req)
    {
    	Core::setConnection();	
    	$input = $req->all();	
    	$input['status'] = 'ONGOING';
    	$input['user_id'] = Auth::user()->user_id;
    	
    	$validate = Validator::make($input, Transfer::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        Transfer::create($input);
        Session::put('transferFloat',$input);

        //$stockinFloat = //StockinFloat::create($input);
        //if($stockinFloat)        
        return Response::json(['status'=>true,'message' => "Successfuly added!",'stockin'=>$input]);
    }

    public function transferList()
    {
    	Core::setConnection();
        $transfer = Transfer::with('items')->where('user_id',Auth::user()->user_id)
    						->where('status','ONGOING')
    						->orderBy('transfer_id', 'desc')->first();
    					
    	
    	$jdata['prodlist'] = (!is_null($transfer->items)) ? $transfer->items : [];;

    	$jdata['transfer'] = (!is_null($transfer)) ? $transfer : [];;
    	return $jdata;	
    }
     public function saveItems(Request $req)
    {
    	Core::setConnection();

        $available = StockOut::available($req->id,$req->branch_id);
    	if($available <= 0)
    	{
    		return Response::json(['status' => false, 'message' =>["Already out of stock"]]);
    	}else if($available < $req->qty)
    	{
    		return Response::json(['status' => false, 'message' =>["Out of range. There are only ".$available." stocks available"]]);
    	}

    	$transfer_item = new TransferItem;
    	$transfer_item->product_id = $req->id;
        $transfer_item->quantity = $req->qty;       
        $transfer_item->transfer_id = $req->transfer_id;
        $transfer_item->cost_price = $req->costprice;
        if($transfer_item->save())
        	return Response::json(['status' => true, 'message' =>["Item are now book"]]);

        return Response::json(['status' => false, 'message' =>["Error"]]);
    }

    public function search()
    {
    	 $src ="transfer";
        return view('products.search',compact('src'));
    }
    public function postSearch(Request $req)
    {
    	Core::setConnection();       
    	$branch = $req->branch_id;

        $search = $req->str;
        if($search =='%')
            $search ="";
       
       	$sql = "
       			SELECT distinct(p.product_id) as pid,p.*,c.category_code FROM product p
                LEFT JOIN category c ON p.category_id = c.category_id
                LEFT JOIN supplier_category sc ON c.category_id = sc.category_id
                WHERE  (product_code LIKE ('%".$search."%') OR 
                  barcode LIKE ('%".$search."%') OR product_name LIKE ('%".$search."%') )
                  AND p.suspended = 0  AND
       		 	p.product_id IN (
					SELECT DISTINCT(product_id) FROM stockin_item si
					LEFT JOIN `stockin` s ON si.stockin_id = s.stockin_id
					WHERE s.branch_id = $branch 
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
}
