<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promo;
use App\Models\PromoNeed;
use App\Models\Branch;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use Validator;
use Response;
use Redirect;
use Auth;
use Config;
class PromoController extends Controller
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

    return view('promo.index');
  }

  public function create()
  {
    if(!Core::setConnection())
    {
     return redirect()->intended('login');
    }
    if(Auth::user()->level_id > 2){
      $products =  Product::with('category')->orderBy('product_name','ASC')->get();
    }else {
        $products =  Product::whereRaw('product_id IN (SELECT DISTINCT(product_id) FROM stockin_item si
        LEFT JOIN `stockin` s ON si.stockin_id = s.stockin_id
        WHERE s.branch_id = '.Auth::user()->branch_id.')')->orderBy('product_name','ASC')->get();
    }
    $branches = Branch::get();
    return view("promo.create",compact('products','branches'));
  }

  public function store(Request $request)
  {
    if(!Core::setConnection())
    {
     return redirect()->intended('login');
    }
    $promo = $request->promo;
    $promo['user_id'] = Auth::user()->user_id;
    $promo['start_date'] = date("Y-m-d",strtotime($promo['start']));
    $promo['end_date'] = date("Y-m-d",strtotime($promo['end']));
    $promo['post_date'] = Setting::first()->pluck('post_date')[0];
    $validate = Validator::make($promo, Promo::$rules);
     if($validate->fails())
     {
         return Response::json(['status'=>false,'message' => $validate->messages()]);
     }
     $newPromo = Promo::create($promo);
     if($newPromo){
       $needs = $request->need;
       $this->insertNeed($needs,$newPromo);
       $this->insertExclude($request->branch,$newPromo);
       return Response::json(['status'=>true,'message' => "Successfully save!"]);
     }
    return Response::json(['status'=>false,'message' => "Error in saving!"]);
  }

  public function promo_list(Request $req)
  {
    if(!Core::setConnection())
    {
     return redirect()->intended('login');
    }
    Core::setConnection();
    $start = $req->offset;
    $limit = $req->limit;
    $filter = @$req->searchStr;
    $status = @$req->status;
  
    $sql = Promo::status($status)
        ->with(['product' => function($q) {
            $q->with('category');
    }])
    ->leftJoin('product','promo.product_id','product.product_id')
    ->leftJoin('category','product.category_id','category.category_id')
    ->leftJoin('promo_exclude_branch','promo.promo_id','promo_exclude_branch.promo_id')
        ->whereRaw("promo_exclude_branch.promo_id NOT IN (SELECT  peb.promo_id FROM promo_exclude_branch peb WHERE peb.promo_id = promo.promo_id  and  peb.branch_id ='".Auth::user()->branch_id."')")
        ->whereRaw("(promo.promo_id LIKE('%".$filter."%') OR product.product_name LIKE('%".$filter."%') OR category.category_name LIKE('%".$filter."%'))")
        ->select('promo.*');

    $total = $sql->count();
    $list = $sql->skip($start)->take($limit)->get();

    $rows = array_map(function($row){
      $action = "<div class='text-center'><a data-id='".$row['promo_id']."' href='javascript:void(0)' title='Edit Product' class='product-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
      $action .= "</div>";
      return [
          'action' => $action,
          'promo_id' => $row['promo_id'],
          'category_name'=> $row['product']['category']['category_name'],
          'start_date'=> $row['start_date'],
          'end_date'=> $row['end_date'],
          'promo_price'=> $row['promo_price'],
          'promo_discount'=> $row['promo_discount']
      ];
    },$list->toArray());
    return response()->json(['rows'=>$rows,'total'=>$total]);

  }

  private function insertNeed($needs,$promo)
  {
    foreach($needs as $need)
    {
      $datum = ['product_id' => $need['pid'],'quantity' => $need['qty']];
      $promo->need()->create($datum);

    }
  }

  private function insertExclude($excludes,$promo)
  {
    foreach($excludes as $ex)
    {
      $datum = ['branch_id'=>$ex['branch_id']];
      $promo->exclude()->create($datum);

    }
  }
}
