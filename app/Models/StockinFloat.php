<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockinFloat extends Model
{
    protected $connection = 'domain';
    protected $table = 'stockin_float';
    protected $primaryKey ='stockin';

    public static $rules = ['supplier_id' => 'required',
    						'branch_id' => 'required',
    						'doc_no' => 'required']; 

    protected $fillable = ['branch_id','notes' ,'supplier_id',
    						'type','doc_no','doc_date','status',
    						'user_id','encode_date'];

}
