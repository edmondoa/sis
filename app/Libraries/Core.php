<?php
namespace App\Libraries;
use Config;
use Session;
use Auth;
class Core 
{
	public static function setConnection()
	{
		
		if(Session::has('dbname') && Auth::check()){
			Config::set('database.connections.domain.database',Session::get('dbname'));
			return true;
		}
			 return false;
		
		
	}

}