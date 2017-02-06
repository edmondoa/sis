<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //protected $connection = 'domain';
    protected $table = 'product';
    protected $primaryKey = 'product_id';



    protected $fillable =['product_code','product_name','barcode',
                        'model_no','retail_price','category_id',
                        'cost_price','discount_id','non_book','non_consign',
                        'non_returnable','vatable','tieup','group_id',
                        'lock','suspended','notes','post_date','user_id',];

    public static $rules = [
    			'product_code' => 'required',
    			'category_id' => 'required',
    			'product_name' => 'required',
    			'retail_price' => 'required|numeric|between:0,99999999.99',
                'cost_price' => 'required|numeric|between:0,99999999.99',
                             
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
