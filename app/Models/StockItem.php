<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $connection = 'domain';
    protected $table = 'stockin_item';
    public $timestamps = false;
    
    public $fillable = ['product_id','cost_price','quantity','stockin_float_id'];
}
