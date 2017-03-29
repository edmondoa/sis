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
    $start = ($req->page - 1) * $req->count;
    $limit = $req->count;
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

    $pages = $total / $limit;
    $pagination=['count' =>$limit,'page'=>$req->page,'pages'=>ceil($pages),'size'=>$total];
    $header = Config::get('header.promo');
    return response()->json(['list'=>$list,'header'=>$header,'pagination'=>$pagination]);

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
