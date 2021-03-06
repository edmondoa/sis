<?php

namespace App\Http\Controllers;

use App\Models\AccountLevel;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;
use App\Libraries\Core;
use Redirect;
class AccountLevelController extends Controller
{
    //
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
    	return view('accounts.account_level');
    }

    public function store(Request $req)
    {
       Core::setConnection();
    	$inputs = $req->all();    	
    	$validate = Validator::make($inputs, AccountLevel::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
       
        $account_level = AccountLevel::create($inputs);
        if($account_level)        
        	return Response::json(['status'=>true,'message' => "Successfully created!"]);
        
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function edit($id)
    {
        Core::setConnection();
        $acc_level = AccountLevel::find($id);
        return view('accounts.account_level_edit',compact('acc_level'));
    }

    public function update(Request $request,$id)
    {
        Core::setConnection();
        $jdata['status'] = false;
        $jdata['message'] = "Error in updating, Please contact the administrator";
        
        $validate = Validator::make($request->all(), self::rules($id));
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $acc_level = AccountLevel::find($id);
        $acc_level->level_name = $request->level_name;
        $acc_level->credit_days = $request->credit_days;
        
        if($acc_level->save())
        {
            $jdata['status'] = true;
            $jdata['message'] = "Successfully updated!";
     
        }
        return $jdata;
    }

    private function rules($param)
    {
        return [
               'level_name' => 'required|unique:account_level,level_name,'.$param.',level_id',
               'credit_days' => 'sometimes|numeric|between:0,999'   
            ];
    }

    public function level_list()
    {
        Core::setConnection();
    	return AccountLevel::get();
    }
}
