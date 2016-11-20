<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $connection = 'domain';
    protected $table = 'stockin_item';
    protected $primaryKey = 'stockin_item_id';
    public $timestamps = false;
    
    protected $appends = ['branch_id'];
    public $fillable = ['product_id','cost_price','quantity','stockin_id','updated_price'];
    public static $rules = ['code' => 'required',
    						'qty' => 'required|number',
    						'cost' => 'required'];




    public function product()
    {
    	return $this->belongsTo('App\Models\Product')->select('product_id','product_code','product_name','cost_price','category_id');
    }

    public function stock()
    {
        return $this->belongsTo('App\Models\Stockin','stockin_id','stockin_id');
    }	

    public function getBranchIdAttribute()
    {
        return $this->stock->branch_id;
    }

}
