<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferItem extends Model
{
    protected $connection = 'domain';
    protected $table = 'stock_transfer_item'; 
      protected $primaryKey = 'transfer_item_id'; 
    protected $fillable = ['transfer_id','product_id','quantity','cost_price'];
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
