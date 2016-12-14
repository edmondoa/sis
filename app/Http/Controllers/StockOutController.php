<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Setting;
use App\Models\Branch;
use App\Models\Product;
use App\Models\StockOut;
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
    	
    	$validate = Validator::make($input, StockOut::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        Session::put('stockoutFloat',$input);

        //$stockinFloat = //StockinFloat::create($input);
        //if($stockinFloat)        
        return Response::json(['status'=>true,'message' => "Successfuly added!",'stockin'=>$input]);
    }

    public function stockoutList()
    {
    	$jdata['prodlist'] = [];
    	$jdata['stockout'] = (Session::has('stockoutFloat'))?Session::get('stockoutFloat'):[];
    	return $jdata;
    }

    public function search()
    {
    	 $src ="stockout";
        return view('products.search',compact('src'));
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
        	$onhand = StockOut::onhand($product->product_id,$branch);
        	$book  = StockOut::book($product->product_id,$branch);
        	$stockout = StockOut::stockout($product->product_id,$branch);
        	$transfer = StockOut::transfer($product->product_id,$branch);
        	$adjust_out = StockOut::adjust_out($product->product_id,$branch);
        	return [
        		'available' =>$onhand - ($book + $stockout + $transfer + $adjust_out),
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
