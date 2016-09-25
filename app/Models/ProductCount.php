<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCount extends Model
{
    protected $table ="product_count";

    protected $fillable = ['branch_id','notes','post_date','user_id'];
}
