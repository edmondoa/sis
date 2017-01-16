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
use App\Libraries\Core;
use App\Http\Requests;
use Validator;
use Response;
use Auth;
use Session;
use DB;
use PDF;
use Redirect;
class StockOutController extends Controller
{
    
    public function __construct()
    {        
        $this->middleware('web');
    }
    public function index()
    {
    	Core::setConnection();
        $suppliers = Supplier::get();
    	$branches = Branch::get();
    	return view('stockout.index',compact('suppliers','branches'));
    }

    public function stockoutFloat(Request $req)
    {
    	Core::setConnection();
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
    	Core::setConnection();
        $stockout = StockOut::with('items')->where('user_id',Auth::user()->user_id)
    						->where('status','ONGOING')
    						->orderBy('stockout_id', 'desc')->first();
    					
    	$jdata['prodlist'] = (!is_null($stockout)) ? $stockout->items : [];;

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
    	Core::setConnection();
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
    	Core::setConnection();
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
    	Core::setConnection();
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
        $stockout_item->branch_id = $req->branch_id;
        $stockout_item->stockout_id = $req->stockout_id;
        $stockout_item->cost_price = $req->costprice;
        if($stockout_item->save())
        	return Response::json(['status' => true, 'message' =>["Item are now book"]]);

        return Response::json(['status' => false, 'message' =>["Error"]]);
    }

    public function removeItems(Request $req)
    {
    	Core::setConnection();
        $item = StockOutItem::where('stockout_item_id',$req->stockout_item_id)    						
    						->delete();
    	return Response::json(['status'=>true,'message' => "Successfuly remove!"]);
    					
    }

    public function save()
    {
    	Core::setConnection();
        $stockout = StockOut::with('items')->where('user_id',Auth::user()->user_id)
    						->where('status','ONGOING')
    						->first();
    	$stockout->status = "PENDING";
    	$stockout->encode_date = date("Y-m-d");    
    	$stockout->save();
    	$post_date = Setting::first()->pluck('post_date')[0];
    	$stockout->approval()->create([
                            'status' => 'PENDING',
                            'user_id' => Auth::user()->user_id,
                            'post_date' => $post_date,
                            'branch_id' => $stockout->branch_id,
                            'approval_type_id' =>2
                            ]);
    	Session::forget('prodlist');
    	Session::forget('stockinFloat');
    	return Response::json(['status'=>true,'message' => "Successfuly save!"]);
    }

    public function show($id)
    {
        Core::setConnection();
        $stockout = StockOut::with('items','branch')->find($id);

        return view('stockout.show',compact('stockout'));
    }

    public function cancel()
    {
        Core::setConnection();
        $stockout = StockOut::with('items')->where('user_id',Auth::user()->user_id)
                            ->where('status','ONGOING')
                            ->first();
        $stockout->items()->delete();
        $stockout->delete();  
        $jdata['status'] = true;
        $jdata['message'] ="Successfuly cancelled!";
        return $jdata;                  
    }

    public function pdf($id)
    {
        Core::setConnection();
        $stockout = Stockout::with('items','branch')->find($id);
        $filename = $stockout->branch_id."-".$stockout->stockout_id.".pdf";
        $data =  array( 'stockout' => $stockout );
        $pdf = PDF::loadView('pdf.stockout', $data);
        return $pdf->download($filename);
    }
}
