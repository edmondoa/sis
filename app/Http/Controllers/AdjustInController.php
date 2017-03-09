<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Setting;
use App\Models\AdjustIn;
use App\Models\AdjustInItem;
use Session;
use Auth;
use Validator;
use Response;
use DB;
class AdjustInController extends Controller
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
      return view('adjust_in.index',compact('branches','post_date'));

  }

  public function adjustinList()
  {
    if(!Core::setConnection()){
          return Redirect::to("/login");
      }
    $jdata['prodlist'] = (Session::has('adjustprodlist'))?Session::get('adjustprodlist'):[];
    $jdata['adjustin'] = (Session::has('adjustInFloat'))?Session::get('adjustInFloat'):[];
    return $jdata;
  }

  public function adjustinFloat(Request $req)
  {
    if(!Core::setConnection()){
          return Redirect::to("/login");
      }
    $input = $req->all();
    $input['user_id'] = Auth::user()->user_id;
    $input['type'] = "PURCHASE";
    $post_date = Setting::first()->pluck('post_date')[0];
    $validate = Validator::make($input, AdjustIn::$rules);
      if($validate->fails())
      {
          return Response::json(['status'=>false,'message' => $validate->messages()]);
      }


      Session::put('adjustInFloat',$input);

      //$stockinFloat = //StockinFloat::create($input);
      //if($stockinFloat)
      return Response::json(['status'=>true,'message' => "You can now proceed!",'adjustin'=>$input]);
  }

  public function search()
  {
    if(!Core::setConnection()){
        return Redirect::to("/login");
    }
    $src ="adjustin";
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
    if(!Core::setConnection()){
          return Redirect::to("/login");
      }
    $prodlist = (Session::has('adjustprodlist'))?Session::get('adjustprodlist'):[];

    $prod = Product::find($req->id);
    $prod->quantity = $req->qty;
    $prod->cost_price = $req->costprice;
    $prod->total = number_format(($req->qty * $req->costprice), 2);

    array_push($prodlist,$prod);

    Session::put('adjustprodlist',$prodlist);
    $jdata['prodlist'] =$prodlist;
    return $jdata;
  }

  public function save(Request $req)
  {
    if(!Core::setConnection()){
          return Redirect::to("/login");
      }
    $rows = count($req->quantity) - 1 ;
    $post_date = Setting::first()->pluck('post_date')[0];
    $adjustin = Session::get('adjustInFloat');

    $adjustin['encode_date'] = $post_date;
    $adjustin['notes'] = $req->notes;
    $stock = AdjustIn::create($adjustin);

    $prodlist = array_reverse(Session::get('adjustprodlist'));
    foreach($prodlist as $prod)
    {
      $item = [
        'product_id' => $prod->product_id,
        'quantity'	 => $prod->quantity,
        'cost_price' => $prod->cost_price,
        'stock_adj_in_id' => $stock->stock_adj_in_id
      ];
      AdjustInItem::create($item );
    }
      $stock->approval()->create([
                          'status' => 'PENDING',
                          'user_id' => Auth::user()->user_id,
                          'post_date' => $post_date,
                          'branch_id' => $stock->branch_id,
                          'approval_type_id' =>4
                          ]);
    Session::forget('adjustprodlist');
    Session::forget('adjustInFloat');
    return Response::json(['status'=>true,'message' => "AdjustIn #".$stock->stockin_id." was successfully saved for approval!"]);
  }

  public function singleSearch($search=NULL)
  {
      Core::setConnection();
      if (is_null($search)) $search ="";
      $sql = "SELECT p.*,c.category_code FROM product p
              LEFT JOIN category c ON p.category_id = c.category_id
              WHERE (product_code = '".$search."' OR
                barcode = '".$search."') AND p.suspended = 0";
      $products = DB::select($sql);
      if(count($products) > 0)
          return Response::json(['status'=>true,'products'=>$products]);
      return Response::json(['status'=>false,'products'=>[]]);
  }

  public function removeItems($key)
  {
    if(!Core::setConnection()){
          return Redirect::to("/login");
      }
      $prodlist = (Session::has('adjustprodlist'))?Session::get('adjustprodlist'):[];
    unset($prodlist[$key]);
    $prodlist = array_values($prodlist);
    Session::put('adjustprodlist',$prodlist);
    return Response::json(['status'=>true,'message' => "Successfully removed!"]);
  }

  public function cancel()
  {
    if(!Core::setConnection()){
          return Redirect::to("/login");
      }
    Session::forget('adjustprodlist');
    Session::forget('adjustInFloat');
    $jdata['prodlist'] = [];
    $jdata['stockin'] = [];
    $jdata['status'] = true;
    $jdata['message'] ="AdjustIn was successfully cancelled!";
    return $jdata;
  }

  public function show($id)
  {
    if(!Core::setConnection()){
        return Redirect::to("/login");
    }
    $adjustin = AdjustIn::with('items','branch','user')->find($id);
    return view('adjust_in.show',compact('adjustin'));
  }
}
