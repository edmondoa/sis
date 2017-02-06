<?php
namespace App\Libraries;
use Config;
use Session;
use Auth;
use DB;
use Orchestra\Support\Facades\Tenanti;
use Redirect;
class Core 
{
	public static function setConnection()
	{
		if(!Session::has('domain_exist')){
            Auth::logout();
            return false;
        }else{
			Tenanti::driver('domain')->asDefaultConnection(Session::get('domain_exist'), 'domain{id}');
			return true;
		}
	}

	public static function setConnection2($data)
	{

		Config::set('database.connections.domain.host',$data['host']);
		Config::set('database.connections.domain.database',$data['database']);
		Config::set('database.connections.domain.username',$data['username']);
		Config::set('database.connections.domain.password',$data['password']);
		
		
	}

}