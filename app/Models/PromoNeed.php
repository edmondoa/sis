<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoNeed extends Model
{
  protected $table = 'promo_need';

  public $timestamps = false;

  protected $fillable =['promo_id','product_id','quantity'];


}
