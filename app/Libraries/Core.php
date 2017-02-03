<?php
namespace App\Libraries;
use Config;
use Session;
use Auth;
use DB;
class Core 
{
	public static function setConnection()
	{
		//dump(Auth::user()->domain);
		//exit;
		if(Auth::check()){
			Config::set('database.connections.domain.host',Auth::user()->domain->master->host);
			Config::set('database.connections.domain.database',Auth::user()->domain->dbname);
			Config::set('database.connections.domain.username',Auth::user()->domain->master->username);
			Config::set('database.connections.domain.password',Auth::user()->domain->master->password);
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