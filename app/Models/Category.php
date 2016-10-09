<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'domain';
    protected $table = 'category';
    protected $primaryKey = "category_id";
    public static $rules = ['category_name' => 'required|unique:category,category_name']; 

    protected $fillable = ['sys_category_id','category_name','default_discount_id'];
}
