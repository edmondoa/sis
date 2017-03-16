<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Branch;
use App\Models\Setting;
use App\Models\AdjustOut;
use App\Models\StockOut;
use App\Models\AdjustOutItem;

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
      $adjustout = AdjustOut::where('user_id',Auth::user()->user_id)
    						->where('status','ONGOING')
                ->with('items')
    						->orderBy('stock_adj_out_id', 'desc')->first();


      $jdata['prodlist'] = (!is_null($adjustout)) ? $adjustout->items : [];

    	$jdata['adjustout'] = (!is_null($adjustout)) ? $adjustout : [];
      // dump($jdata);
      // exit;
    	return $jdata;
    }

    public function adjustoutFloat(Request $req)
    {
      Core::setConnection();
      $input = $req->all();
    	$input['status'] = 'ONGOING';
    	$input['user_id'] = Auth::user()->user_id;
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

    public function show($id)
    {
      Core::setConnection();
      $adjustout = AdjustOut::with('items','branch')->find($id);

      return view('adjust_out.show',compact('adjustout'));
    }

    public function pdf($id)
    {
        Core::setConnection();
        $adjustout = AdjustOut::with('items','branch')->find($id);
        $filename = $adjustout->branch_id."-".$adjustout->stock_adj_out_id.".pdf";
        $data =  array( 'adjustout' => $adjustout );
        $pdf = PDF::loadView('pdf.adjustout', $data);
        return $pdf->download($filename);
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

        Core::setConnection();
        $available = StockOut::available($req->id,$req->branch_id);
      	if($available <= 0)
      	{
      		return Response::json(['status' => false, 'message' =>["Already out of stock"]]);
      	}else if($available < $req->qty)
      	{
      		return Response::json(['status' => false, 'message' =>["Out of range. There are only ".$available." stocks available"]]);
      	}
        $adjustout_item = new AdjustOutItem;
      	$adjustout_item->product_id = $req->id;
        $adjustout_item->quantity = $req->qty;
        $adjustout_item->stock_adj_out_id = $req->stock_adj_out_id;
        $adjustout_item->cost_price = $req->costprice;
        if($adjustout_item->save())
        	return Response::json(['status' => true, 'message' =>["Item are now book"]]);

        return Response::json(['status' => false, 'message' =>["Error"]]);
    }

    public function save(Request $req)
    {
        Core::setConnection();
          $adjustout = AdjustOut::with('items')->where('user_id',Auth::user()->user_id)
      						->where('status','ONGOING')
      						->first();
      	$adjustout->status = "PENDING";
      	$adjustout->encode_date = date("Y-m-d");
        $adjustout->notes = $req->notes;
      	$adjustout->save();
      	$post_date = Setting::first()->pluck('post_date')[0];
      	$adjustout->approval()->create([
                              'status' => 'PENDING',
                              'user_id' => Auth::user()->user_id,
                              'post_date' => $post_date,
                              'branch_id' => $adjustout->branch_id,
                              'approval_type_id' =>5
                              ]);
      	return Response::json(['status'=>true,'message' => "Successfully save!"]);
    }

    public function cancel()
    {
      Core::setConnection();
      $adjustout = AdjustOut::with('items')->where('user_id',Auth::user()->user_id)
                          ->where('status','ONGOING')
                          ->first();
      $adjustout->items()->delete();
      $adjustout->delete();
      $jdata['status'] = true;
      $jdata['message'] ="Successfully cancelled!";
      return $jdata;
    }

}
