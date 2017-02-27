<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdjustIn extends Model
{
    //protected $connection = 'domain';
    protected $table = 'stock_adj_in';
    protected $primaryKey ='stock_adj_in_id';

    public static $rules = ['supplier_id' => 'required',
    						'branch_id' => 'required',
    						'doc_no' => 'required|unique_with:stockin,branch_id'];

    protected $fillable = ['branch_id','notes' ,
    						'type','doc_no','doc_date','status','encode_date',
    						'user_id','post_date','arrive_date','approval_id'];

    public function items()
    {
    	return $this->hasMany('App\Models\StockItem','stockin_id','stockin_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branch_id','branch_id')->select('branch_id','branch_name','business_name');
    }

     public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
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
