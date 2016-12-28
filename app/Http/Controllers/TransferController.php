<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Branch;
use App\Http\Requests;

class TransferController extends Controller
{
    public function index()
    {
    	Core::setConnection();
        $branches = Branch::get();
    	return view('transfer.index',compact('branches'));
    }
}
