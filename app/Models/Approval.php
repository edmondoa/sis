<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $connection = 'domain';
     protected $table ='approval';
    protected $primaryKey = 'approval_id';
    public $timestamps = false;
    protected $fillable =['type','approver_user_id','approve_date',
    					 'post_date','notes','user_id','status'];
}
