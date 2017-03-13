<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Branch;
use App\Models\Setting;
use App\Models\AdjustOut;

use App\Http\Requests;
use Validator;
use Response;
use Auth;
use Session;
use DB;
use PDF;
use Redirect;
class AdjustOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }
    public function index()
    {
      if(!Core::setConnection())
        {
            return redirect()->intended('login');
        }

      $branches = Branch::get();
      $post_date = Setting::first()->pluck('post_date')[0];
      return view('adjust_out.index',compact('branches','post_date'));
    }

    public function adjustOutList()
    {
      Core::setConnection();
        $adjustout = AdjustOut::with('items')->where('user_id',Auth::user()->user_id)
    						->where('status','ONGOING')
    						->orderBy('stock_adj_out_id', 'desc')->first();

    	$jdata['prodlist'] = (!is_null($adjustout)) ? $adjustout->items : [];;

    	$jdata['adjustout'] = (!is_null($adjustout)) ? $adjustout : [];;
    	return $jdata;
    }

    public function adjustoutFloat(Request $req)
    {
      Core::setConnection();
      $input = $req->all();
    	$input['status'] = 'ONGOING';
    	$input['user_id'] = Auth::user()->user_id;
      $input['encode_date'] = date('Y-m-d');
    	$validate = Validator::make($input, AdjustOut::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        AdjustOut::create($input);
        return Response::json(['status'=>true,'message' => "Successfully added!",'adjustout'=>$input]);
    }

    public function search()
    {
      if(!Core::setConnection()){
          return Redirect::to("/login");
      }
      $src ="adjustout";
      return view('products.search',compact('src'));
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
               WHERE (product_code LIKE ('%".$search."%') OR
                 barcode LIKE ('%".$search."%') OR product_name LIKE ('%".$search."%') )
                 AND p.suspended = 0  LIMIT 15";
       $products = DB::select($sql);
       if(count($products) > 0){
           return Response::json(['status'=>true,'products'=>$products]);
       }
       return Response::json(['status'=>false,'products'=>[]]);
    }

    public function saveItems(Request $req)
    {
      
    }

}
