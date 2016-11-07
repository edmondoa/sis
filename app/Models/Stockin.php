<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockin extends Model
{
    protected $connection = 'domain';
    protected $table = 'stockin';
    protected $primaryKey ='stockin_id';

    public static $rules = ['supplier_id' => 'required',
    						'branch_id' => 'required',
    						'doc_no' => 'required']; 

    protected $fillable = ['branch_id','notes' ,'supplier_id',
    						'type','doc_no','doc_date','status','encode_date',
    						'user_id','post_date','arrive_date','approval_id'];

    public function items()
    {
    	return $this->belongsTo('App\Models\StockItem','stockin_id','stockin_id');
    }

    public function approval()
    {
        return $this->morphMany('App\Models\Approval', 'approvalable');
    }
}
