<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Customer;
use Validator;
use Response;
use Auth;
class CustomerController extends Controller
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

    return view('customers.index');
  }

  public function create()
  {
    if(!Core::setConnection())
    {
     return redirect()->intended('login');
    }
    return view('customers.create');
  }

  public function store(Request $req)
  {
    Core::setConnection();
    $inputs = $req->all();
    $inputs['birthdate'] = date('Y-m-d',strtotime($inputs['birthdate']));
    $inputs['user_id'] = Auth::user()->user_id;
    $validate = Validator::make($inputs, Customer::$rules);
     if($validate->fails())
     {
         return Response::json(['status'=>false,'message' => $validate->messages()]);
     }

     $customer = Customer::create($inputs);
     if($customer)
       return Response::json(['status'=>true,'message' => "Customer successfully created!",'customer_id'=>$customer->customer_id]);

     return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
  }

  public function show($id)
  {
    if(!Core::setConnection())
    {
     return redirect()->intended('login');
    }
    $customer = Customer::find($id);
    return view('customers.show',compact('customer'));
  }
}
