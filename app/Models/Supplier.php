<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $connection = 'domain';
    protected $table = 'supplier';

     public static $rules = ['supplier_name' => 'required|unique:supplier,supplier_name',
     						 'email'=>'email']; 

    protected $fillable = ['supplier_name','contact_person','mobile1_no','mobile2_no',
    						'landline_no','email','notes'];
}
