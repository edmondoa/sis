<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //protected $connection = 'domain';
    protected $table = 'discount';

    public static $rules = [
    			'category_id' => 'required',
    			'level_id' => 'required',
    			'cash' => 'required|numeric|between:0,100.99',
    			'credit' => 'required|numeric|between:0,100.99',
    			]; 

    protected $fillable = ['category_id','level_id','cash','credit','notes'];

    public function category()
    {
    	return $this->belongsTo('App\Models\Category','category_id','category_id');
    }

    public function account_level()
    {
    	return $this->belongsTo('App\Models\AccountLevel','level_id','level_id');
    }
}
