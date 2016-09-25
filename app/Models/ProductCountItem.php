<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCountItem extends Model
{
    protected $table ="product_count_item";

    protected $fillable = ['count_id','product_id','on_hand','physical_count'];
}
