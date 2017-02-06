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
		if(!Session::has('domain_exist'))
			return false;
		Tenanti::driver('domain')->asDefaultConnection(Session::get('domain_exist'), 'domain{id}');
		return true;
		//dump(Auth::check());exit;
		if(!Auth::check())
		{
			 return false;
		}else{

			Config::set('database.connections.domain.host',Auth::user()->domain->master->host);
			Config::set('database.connections.domain.database',Auth::user()->domain->dbname);
			Config::set('database.connections.domain.username',Auth::user()->domain->master->username);
			Config::set('database.connections.domain.password',Auth::user()->domain->master->password);
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