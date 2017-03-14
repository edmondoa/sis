<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdjustOutItem extends Model
{
  //protected $connection = 'domain';
    protected $table = 'stock_adj_out_item';
    public $timestamps = false;


    public $fillable = ['product_id','cost_price','quantity','stock_adj_out_id'];
    public static $rules = ['code' => 'required',
                'qty' => 'required|number',
                'cost' => 'required'];
    protected $appends = ['product_name','product_code','total','branch_id'];



    public function product()
    {
      return $this->belongsTo('App\Models\Product')->select('product_id','product_code','product_name','cost_price','category_id');
    }

    public function ajust_out()
    {
        return $this->belongsTo('App\Models\AdjustOut','stock_adj_out_id','stock_adj_out_id');
    }

    public function getBranchIdAttribute()
    {
        return $this->ajust_out->branch_id;
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
