<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    //protected $connection = 'domain';
    protected $table = 'stock_transfer';
    protected $primaryKey = 'transfer_id';
    protected $fillable = ['orig_branch_id','recv_branch_id','notes','recv_user_id','encode',
    						'recv_branch_id','user_id','status','arrive_date'];
    public $timestamps = false;

    public static $rules =['orig_branch_id' => 'required',
    						'recv_branch_id' => 'required',
    						]; 

    public function items()
    {
    	return $this->hasMany('App\Models\TransferItem','transfer_id','transfer_id');
    }

    public function branch_orig()
    {
        return $this->belongsTo('App\Models\Branch','orig_branch_id','branch_id')->select('branch_id','branch_name','business_name');
    }

    public function branch_transfer()
    {
        return $this->belongsTo('App\Models\Branch','recv_branch_id','branch_id')->select('branch_id','branch_name','business_name');
    }                       
						

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function approval()
    {
        return $this->morphOne('App\Models\Approval', 'approvalable');
    }

}
