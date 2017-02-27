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
use App\Libraries\Core;
use App\Http\Requests;
use Validator;
use Response;
use Auth;
use Session;
use PDF;
use Redirect;
use Config;
class StockinController extends Controller
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
        $suppliers = Supplier::get();

    	$branches = Branch::get();
        $post_date = Setting::first()->pluck('post_date')[0];
    	return view('stockin.index',compact('suppliers','branches','post_date'));
    }

    public function search()
    {
        if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        $src ="stockin";
        return view('products.search',compact('src'));
    }

    public function stockFloat(Request $req)
    {
    	if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        $input = $req->all();
    	$input['user_id'] = Auth::user()->user_id;
    	$input['type'] = "PURCHASE";
    	$post_date = Setting::first()->pluck('post_date')[0];
    	$validate = Validator::make($input, $this->rules($input['branch_id'],$post_date));
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }


        Session::put('stockinFloat',$input);

        //$stockinFloat = //StockinFloat::create($input);
        //if($stockinFloat)
        return Response::json(['status'=>true,'message' => "Document was successfully validated!",'stockin'=>$input]);

        //return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function stockFloatItems(Request $req)
    {
    	if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        $prodlist = (Session::has('prodlist'))?Session::get('prodlist'):[];

    	$prod = Product::find($req->id);
        $prod->quantity = $req->qty;
        $prod->cost_price = $req->costprice;
        $prod->total = number_format(($req->qty * $req->costprice), 2);

    	 array_push($prodlist,$prod);

    	Session::put('prodlist',$prodlist);
    	$jdata['prodlist'] =$prodlist;
    	return $jdata;
    }

    public function stockinList()
    {
    	if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        $jdata['prodlist'] = (Session::has('prodlist'))?Session::get('prodlist'):[];
    	$jdata['stockin'] = (Session::has('stockinFloat'))?Session::get('stockinFloat'):[];
    	return $jdata;
    }

    public function cancel()
    {
    	if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        Session::forget('prodlist');
    	Session::forget('stockinFloat');
    	$jdata['prodlist'] = [];
    	$jdata['stockin'] = [];
    	$jdata['status'] = true;
    	$jdata['message'] ="StockIn was successfully cancelled!";
    	return $jdata;
    }

    public function stockFloatSave(Request $req)
    {
    	if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        $rows = count($req->quantity) - 1 ;
    	$post_date = Setting::first()->pluck('post_date')[0];
    	$stockin = Session::get('stockinFloat');

        $stockin['arrive_date'] = date("Y-m-d",strtotime($stockin['arrive_date']));
        $stockin['doc_date'] = date("Y-m-d",strtotime($stockin['doc_date']));
        $stockin['encode_date'] = $post_date;
        $stockin['notes'] = $req->notes;
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
        $stock->approval()->create([
                            'status' => 'PENDING',
                            'user_id' => Auth::user()->user_id,
                            'post_date' => $post_date,
                            'branch_id' => $stock->branch_id,
                            'approval_type_id' =>1
                            ]);
    	Session::forget('prodlist');
    	Session::forget('stockinFloat');
    	return Response::json(['status'=>true,'message' => "StockIn #".$stock->stockin_id." was successfully saved for approval!"]);

    }

    public function removeItems($key)
    {
    	if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        $prodlist = (Session::has('prodlist'))?Session::get('prodlist'):[];
    	unset($prodlist[$key]);
    	$prodlist = array_values($prodlist);
    	Session::put('prodlist',$prodlist);
    	return Response::json(['status'=>true,'message' => "Successfully removed!"]);
    }

    public function stockFloatUpdate(Request $req)
    {
    	if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        $prodlist = (Session::has('prodlist'))?Session::get('prodlist'):[];
    	$prod = $prodlist[$req->key];
    	$row = $req->row;
    	$prod->$row = $req->value;
    	$prod->total = $prod->quantity * $prod->updated_price;
    	Session::put('prodlist',$prodlist);
    }

    public function show($id)
    {
        if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        $stockin = Stockin::with('items','branch','supplier')->find($id);
        return view('stockin.show',compact('stockin'));
    }

    public function stockin_pdf($id)
    {
        if(!Core::setConnection()){
            return Redirect::to("/login");
        }
        $stockin = Stockin::with('items','branch','supplier')->find($id);
        $filename = $stockin->doc_no."-".$stockin->doc_date.".pdf";
        $data =  array( 'stockin' => $stockin );
        $pdf = PDF::loadView('pdf.stockin', $data);
        return $pdf->download($filename);
    }

    private function rules($branch_id,$post_date){
        return [
        'branch_id' => 'required',
        'supplier_id' => 'required',
        'doc_no' => 'required|unique:stockin,doc_no,NULL,id,branch_id,' . $branch_id,
        'doc_date' =>'required|date',
        'arrive_date' =>'required|date',
        'amount_due' => 'sometimes|integer|min:0'];
    }
}
