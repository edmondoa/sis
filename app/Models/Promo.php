<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Promo extends Model
{
  protected $table = 'promo';
  protected $primaryKey = 'promo_id';



  protected $fillable =['description','start_date','end_date',
                      'noon_book','non_consign','promo_price','product_id',
                      'promo_discount','lock','post_date','user_id'];

  public static $rules = [
        'description' => 'required',
        'price' => 'required|numeric|between:0,99999999.99',
        'discount' => 'required|numeric|between:0,100',
        'start_date' => 'date',
        'end_date' => 'date'  ];

  //protected $appends = ['product','category'];

  public function need()
  {
    return $this->hasMany('App\Models\PromoNeed');
  }

  public function exclude()
  {
    return $this->hasMany('App\Models\PromoExclude');
  }

  public function product()
  {
    return $this->belongsTo('App\Models\Product');
  }

  public function getProductAttribute()
  {
    return $this->product->product_name;
  }

  public function getCategoryAttribute()
  {
    return $this->product->category->category_name;
  }
}
