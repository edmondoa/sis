<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferItem extends Model
{
    protected $connection = 'domain';
    protected $table = 'stock_transfer_item';  
    protected $fillable = ['transfer_id','product_id','quantity','cost_price'];
    public $timestamps = false;
}
