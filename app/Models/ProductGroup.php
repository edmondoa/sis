<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    //protected $connection = 'domain';
    protected $table = 'product_group';
    protected $primaryKey = 'group_id';

    public static $rules = ['group_name' => 'required']; 

    protected $fillable = ['group_name','notes'];
}
