<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\ProductCount;
use App\Models\ProductCountItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Response;
use DB;
use Auth;
use Session;
class ProductController extends Controller
{
    
    public function index()
    {
    	$category = Category::get();
        $discount = Discount::with('account_level')->get();
    	return view('products.index',compact('category','discount'));
    }

    public function store(Request $req)
    {
    	$inputs = $req->all();
    	$inputs['post_date'] = date('Y-m-d');
        $inputs['user_id'] = Auth::user()->id;
    	$validate = Validator::make($inputs, Product::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        DB::beginTransaction();
        $product = Product::create($inputs);
        if($product){ 
           // dump($product->product_id);
            $p_count = ProductCount::create(
                            ['branch_id' => Session::get('branch_id'),
                             'notes' => $product->notes,
                             'post_date' => date("Y-m-d"),
                             'user_id' => Auth::user()->id]);
            
            if($p_count)
            {
                //dump($p_count->id);
                $p_count_item = ProductCountItem::create(
                                    ['count_id' => $p_count->id,
                                    'product_id' => $product->id,
                                    'on_hand' => $inputs['quantity'],
                                     'physical_count' => 0
                                    ]);                
                
                if($p_count_item){
                    DB::commit();
                    return Response::json(['status'=>true,'message' => "Successfuly created!"]);
                }
            }       
        	
        }
        DB::rollback();
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function product_list()
    {
    	return Product::with('category')->get();
    }
}
