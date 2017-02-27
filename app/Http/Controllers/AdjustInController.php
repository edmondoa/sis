<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Branch;
use App\Models\Setting;
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
}
