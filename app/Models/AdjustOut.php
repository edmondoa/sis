<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdjustOut extends Model
{
  //protected $connection = 'domain';
  protected $table = 'stock_adj_out';
  protected $primaryKey ='stock_adj_out_id';

  public static $rules = ['branch_id' => 'required'];

  protected $fillable = ['branch_id','notes' ,'status','encode_date',
              'user_id','post_date','arrive_date','approval_id','series_id'];

  public function items()
  {
    return $this->hasMany('App\Models\AdjustOutItem','stock_adj_out_id','stock_adj_out_id');
  }

  public function branch()
  {
      return $this->belongsTo('App\Models\Branch','branch_id','branch_id')->select('branch_id','branch_name','business_name');
  }

  public function approval()
  {
      return $this->morphOne('App\Models\Approval', 'approvalable');
  }

  public function user()
  {
      return $this->belongsTo("App\User");
  }
}
