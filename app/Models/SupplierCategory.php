<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierCategory extends Model
{
    protected $connection = 'domain';
    protected $table = 'supplier_category';

    

    protected $fillable = ['supplier_id','category_id'];
}
