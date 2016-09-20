<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mysql';
    protected $table = 'product';

    protected $fillable =['productcode','productname','barcode',
                        'model_no','current_retail_price','category_id',]
                        'last_cost_price';

    public static $rules = [
    			'productcode' => 'required',
    			'category_id' => 'required',
    			'productname' => 'required',
    			'retail_price' => 'required|numeric|between:0,99999999.99'
    ];
    public function category()
    {
    	return $this->belongsTo('App\Models\Category','category_id','category_id');
    }
}
