<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdjustInItem extends Model
{
    //protected $connection = 'domain';
    protected $table = 'stock_adj_in_item';
    public $timestamps = false;


    public $fillable = ['product_id','cost_price','quantity','stock_adj_in_id'];
    public static $rules = ['code' => 'required',
    						'qty' => 'required|number',
    						'cost' => 'required'];




    public function product()
    {
    	return $this->belongsTo('App\Models\Product')->select('product_id','product_code','product_name','cost_price','category_id');
    }

    public function ajust_in()
    {
        return $this->belongsTo('App\Models\AdjustIn','stock_adj_in_id','stock_adj_in_id');
    }

    public function getBranchIdAttribute()
    {
        return $this->stock->branch_id;
    }

}
