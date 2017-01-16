<?php
namespace App\Libraries;
use Config;
use Session;
use Auth;
class Core 
{
	public static function setConnection()
	{
		
		Config::set('database.connections.domain.database',Session::get('dbname')); 
		
		
	}

}