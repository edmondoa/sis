<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\ProductCount;
use App\Models\ProductCountItem;
use App\Models\ProductGroup;
use Illuminate\Http\Request;
use App\Libraries\Core;
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
    	Core::setConnection();
        $category = Category::get();
        $discount = Discount::with('account_level')->get();
        $groups = ProductGroup::get();
    	return view('products.index',compact('category','discount','groups'));
    }

    public function store(Request $req)
    {
    	Core::setConnection();
        $inputs = $req->all();
    	$inputs['post_date'] = date('Y-m-d');
        $inputs['user_id'] = Auth::user()->user_id;
    	$validate = Validator::make($inputs, Product::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }        
        $product = Product::create($inputs);
        if($product){        
            return Response::json(['status'=>true,'message' => "Successfuly created!"]);
        }
       
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function product_list()
    {
    	Core::setConnection();
        return Product::with('category')->get();
    }

     public function edit($id)
    {
        Core::setConnection();
        $category = Category::get();
        $discount = Discount::with('account_level')->get();
        $groups = ProductGroup::get();
        $product = Product::find($id);
        return view('products.edit',compact('product','groups','discount','category'));
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
        $product = Product::find($id);
        $product->product_code = $request->product_code;
        $product->product_name = $request->product_name;
        $product->barcode = $request->barcode;
        $product->model_no = $request->model_no;
        $product->retail_price = $request->retail_price;
        $product->category_id = $request->category_id;
        $product->cost_price = $request->cost_price;
        $product->discount_id = $request->discount_id;
        $product->non_book = (isset($request->non_book))?1:0;
        $product->non_consign = (isset($request->non_consign))?1:0;
        $product->non_returnable = (isset($request->non_returnable))?1:0;
        $product->vatable = (isset($request->vatable))?1:0;
        $product->tieup = (isset($request->tieup))?1:0;
        $product->group_id = $request->group_id;
        $product->lock = (isset($request->lock))?1:0;
        $product->suspended = (isset($request->suspended))?1:0;
        $product->notes = $request->notes;
        $product->user_id = Auth::user()->user_id;
    
        if($product->save())
        {
            $jdata['status'] = true;
            $jdata['message'] = "Successfuly updated!";
     
        }
        return $jdata;
    }

    public function search($sup,$search=NULL)
    {
        Core::setConnection();
        if ($search =='_blank') $search ="";
        $sql = "SELECT p.*,c.category_code FROM product p
                LEFT JOIN category c ON p.category_id = c.category_id
                LEFT JOIN supplier_category sc ON c.category_id = sc.category_id
                WHERE sc.supplier_id = $sup
                AND (product_code = '".$search."' OR 
                  barcode = '".$search."') AND p.suspended = 0";
        $products = DB::select($sql);
        if(count($products) > 0)
            return Response::json(['status'=>true,'products'=>$products]);
        return Response::json(['status'=>false,'products'=>[]]);               
    }

    public function multi_search(Request $req)
    {
       Core::setConnection();
        $sup = $req->supplier_id;
        $search = $req->str;
        if($search =='%')
            $search ="";
        $sql = "SELECT p.*,c.category_code FROM product p
                LEFT JOIN category c ON p.category_id = c.category_id
                LEFT JOIN supplier_category sc ON c.category_id = sc.category_id
                WHERE sc.supplier_id = $sup
                AND (product_code LIKE ('%".$search."%') OR 
                  barcode LIKE ('%".$search."%') OR product_name LIKE ('%".$search."%') )
                  AND p.suspended = 0  LIMIT 15";
        $products = DB::select($sql);
        if(count($products) > 0){            
            return Response::json(['status'=>true,'products'=>$products]);
        }
        return Response::json(['status'=>false,'products'=>[]]); 
    }

    private function rules($param)
    {
        return [
                             
                'product_code' => 'required',
                'category_id' => 'required',
                'product_name' => 'required|unique:product,product_name,'.$param.',product_id' ,
                'retail_price' => 'required|numeric|between:0,99999999.99',
                'cost_price' => 'required|numeric|between:0,99999999.99',
                             
                // 'non_returnable' => 'required',
                // 'vatable' => 'required',
                // 'suspended' => 'required',
                // 'lock' => 'required',
            ];

            
    }
}
