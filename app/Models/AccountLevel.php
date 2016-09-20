<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountLevel extends Model
{
	protected $connection = 'domain';
    protected $table ='account_level';

    protected $fillable =['level_name','credit_days'];

    public static $rules =[
    				'level_name' => 'required',
    				'credit_days' => 'sometimes|numeric'    				

    ]	;		

    
}
