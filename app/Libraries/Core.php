<?php
namespace App\Libraries;
use Config;
use Session;
use Auth;
class Core 
{
	public static function setConnection()
	{

		if(Auth::check())
			Config::set('database.connections.domain.database',Auth::user()->domain_name); 
		
	}

}