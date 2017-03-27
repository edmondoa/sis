<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoExclude extends Model
{
  protected $table = 'promo_exclude_branch';  

  protected $fillable =['promo_id','branch_id'];


}
