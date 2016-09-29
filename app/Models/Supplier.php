<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $connection = 'domain';
    protected $table = 'supplier';

     public static $rules = ['supplier_name' => 'required',
     						'category_id' => 'required']; 

    protected $fillable = ['sys_supplier_id','supplier_name'];
}
