<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SupplierController extends Controller
{
    public function index()
    {
    	return view('supplier.index');
    }
}
