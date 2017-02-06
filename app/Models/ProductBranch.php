<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBranch extends Model
{
	//protected $table ='product_branch';
	protected $fillable = ['product_id','branch_id','consigned','transfer',
							'booked','hold','on_hand','storage_id',
							'minimun_stock_quantity','maximum_stock_quantity'];
    //
}
