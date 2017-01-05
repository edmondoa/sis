<?php

namespace App\Http\Controllers\Auth;
//models
use App\Models\UserLevel;
use App\Models\Domain;
use Config;
use Session;
use Redirect;
use Auth;
use App\User;
use App\Libraries\Core;
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
        if(!Session::has('dbname')){
         Session::put('dbname','domain1');     
       }
        $levels =  UserLevel::get(); 
        return view('auth.login',compact('levels'));
    }

    protected function login(Request $req)
    {
        
        
        $domain = $req->domain; 
        $domain_exist = Domain::where('domain_id',$domain)->first();
        
        if($domain_exist)
        {
            if($domain_exist->db_populated==0)
                return Redirect::back()->withErrors(['Domain database not yet ready!']);

            if($domain_exist->lock==1)
                return Redirect::back()->withErrors(['Domain had been locked by owner!']);

            if($domain_exist->suspended==1)
                return Redirect::back()->withErrors(['Domain had been administratively suspended!']);

            
            Session::put('dbname',$domain_exist->dbname);
            Core::setConnection();
            $credentials = ['username'=>$req->username,'password'=>$req->password];
            // $email = $req->username;
          

            if ($errors = Auth::attempt($credentials,true)) { 
                return Redirect::to("/");
            }else{                   
               // $error = "Invalid User";
                return Redirect::back()->withErrors(['Invalid user!']);
            }   
        }else{
            return Redirect::back()->withErrors(['Domain ID does not exist!']);
        }
          
        
    }
     protected function showRegistrationForm()
    {
        return view('auth.register');
    }
    
    protected function logout()
    {
        Core::setConnection();
        Auth::logout();
        return redirect('login');
    }
}
