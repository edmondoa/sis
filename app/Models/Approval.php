<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    //protected $connection = 'domain';
     protected $table ='approval';
    protected $primaryKey = 'approval_id';
    public $timestamps = false;
    protected $fillable =['approvalable_type','approvalable_id','approver_user_id','approve_date',
    					 'post_date','notes','user_id','status','branch_id','approval_type_id'];

    public function approvalable()
    {
        return $this->morphTo();
    }	

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch')->select('branch_id','branch_name');
    }	

    public function approval_type()
    {
    	return $this->belongsTo('App\Models\ApprovalType');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }			 

    				 
}
