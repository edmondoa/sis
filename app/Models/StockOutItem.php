<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOutItem extends Model
{
    //protected $connection = 'domain';
    protected $table = 'stockout_item';
     protected $primaryKey = 'stockout_item_id';
    protected $fillable = ['stockout_id','product_id','quantity','cost_price','branch_id'];
    public $timestamps = false;

    protected $appends = ['product_name','product_code','total'];


    public function product()
    {
    	return $this->belongsTo('App\Models\Product','product_id','product_id');
    }

    public function getProductNameAttribute()
    {
    	return $this->product->product_name;
    }

    public function getProductCodeAttribute()
    {
    	return $this->product->product_code;
    }
    public function getTotalAttribute()
    {
    	return $this->product->cost_price * $this->quantity;
    }
}
