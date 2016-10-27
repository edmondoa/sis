<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $connection = 'domain';
    protected $table = 'stockin_item';
    public $timestamps = false;
    
    public $fillable = ['product_id','cost_price','quantity','stockin_id','updated_price'];
    public static $rules = ['code' => 'required',
    						'qty' => 'required|number',
    						'cost' => 'required']; 
}
