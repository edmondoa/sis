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
use DB;
use Orchestra\Support\Facades\Tenanti;
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
       //$levels =  UserLevel::get(); 
        return view('auth.login');
    }

    protected function login(Request $req)
    {
        
        
        $domain = $req->domain; 
        $domain_exist = Domain::with('master')->where('domain_id',$domain)->first();
        
        if($domain_exist)
        {
            Session::put('domain_exist',$domain_exist);
            if($domain_exist->db_populated==0)
                return Redirect::back()->withErrors(['Finance concern']);
            
            
            $data['host']=$domain_exist->master->hostname;
            $data['database']=$domain_exist->dbname;
            $data['password']=$domain_exist->master->password;
            $data['username']=$domain_exist->master->username;
            // dump($data);
            // Core::setConnection2($data);
            // DB::setDefaultConnection('domain');
           Tenanti::driver('master')->asDefaultConnection($domain_exist, 'domain{id}');
            
            $credentials = ['username'=>$req->username,'password'=>$req->password,'domain_id'=>$req->domain];
           
          
            $errors = Auth::attempt($credentials,true);

            if ($errors) { 

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
        Core::setConnection();
        Auth::logout();
        Session::flush();
        return redirect('login');
    }
}
