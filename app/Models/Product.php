<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'domain';
    protected $table = 'product';

    protected $fillable =['productcode','productname','barcode',
                        'model_no','current_retail_price','category_id',
                        'last_cost_price','discount_id','non_book','non_consign',
                        'non_returnable','vatable','tie_up','group_id','maximum_stock_quantity',
                        'minimum_stock_quantity','lock','suspended','notes','post_date','user_id',];

    public static $rules = [
    			'productcode' => 'required',
    			'category_id' => 'required',
    			'productname' => 'required',
    			'current_retail_price' => 'required|numeric|between:0,99999999.99',
                'last_cost_price' => 'required|numeric|between:0,99999999.99',
                'minimum_stock_quantity' => 'required|numeric',
                'maximun_stock_quantity' => 'required|numeric',                
                'non_returnable' => 'required',
                'vatable' => 'required',
                'suspended' => 'required',
                'lock' => 'required',
                               

    ];
    public function category()
    {
    	return $this->belongsTo('App\Models\Category','category_id','category_id');
    }
}
