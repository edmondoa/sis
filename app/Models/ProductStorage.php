<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStorage extends Model
{
    //protected $connection = 'domain';
    protected $table = 'product_storage';
    protected $primaryKey ='storage_id';

    public static $rules = ['storage_name' => 'required',
    						'branch_id' => 'required']; 

    protected $fillable = ['storage_name','notes' ,'branch_id'];

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id','branch_id');
    }
}
