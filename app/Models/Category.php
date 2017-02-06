<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //protected $connection = 'domain';
    protected $table = 'category';
    protected $primaryKey = "category_id";
    public static $rules = ['category_name' => 'required|unique:category,category_name',
                            'category_code' => 'required|unique:category,category_code']; 

    protected $fillable = ['sys_category_id','category_code','category_name','default_discount_id'];

    protected $appends = ['count_supplier'];

    public function supplier()
    {
    	return $this->belongsToMany('App\Models\Supplier','supplier_category');
    }
    
   
    public function getCountSupplierAttribute()
    {
    	return $this->supplier()->count();
    }

}
