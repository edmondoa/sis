<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'domain';
    protected $table = 'category';

    public static $rules = ['category_name' => 'required']; 

    protected $fillable = ['sys_category_id','category_name','default_discount_id'];
}
