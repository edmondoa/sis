<?php

namespace App\Http\Controllers\Auth;
//models
use App\Models\UserLevel;
use App\Models\Domain;

use Session;
use Redirect;
use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    protected function showLoginForm()
    {        
        $levels =  UserLevel::get(); 
        return view('auth.login',compact('levels'));
    }

    protected function login(Request $req)
    {
        
        
        $domain = $req->domain; 
        $domain_exist = Domain::where('dbname',$domain)->first();
        if($domain_exist)
        {
            if($domain_exist->db_populated==0)
                return Redirect::back()->withErrors(['Finance concern']);
            Session::put('dbname',$domain_exist->dbname);
            $credentials = ['username'=>$req->username,'password'=>$req->password];
            // $email = $req->username;
          

            if ($errors = Auth::attempt($credentials,true)) {
                
                //dump(Auth::user())  
                Session::put('branch_id',Auth::user()->branch_id);     
                return Redirect::to("/");
            }else{                   
               // $error = "Invalid User";
                return Redirect::back()->withErrors(['Invalid user!']);
            }   
        }else{
            return Redirect::back()->withErrors(['Domain does not exist']);
        }
          
        
    }
     protected function showRegistrationForm()
    {
        return view('auth.register');
    }
    
    protected function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
