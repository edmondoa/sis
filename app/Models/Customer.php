<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $table = 'customer';
  protected $primaryKey ='customer_id';

  public static $rules = ['firstname' => 'required',
                          'lastname'  =>  'required',
                          'middlename'=>  'required',
                          'birthdate' =>  'required | date',
                          'sex'       =>  'required',
                          'status'    =>  'required',
                          'email'    =>  'email'];

  protected $fillable = ['firstname','lastname' ,'middlename','nickname','birthdate','sex',
                        'maritalstatus','addressline1','addressline2','city','province',
                        'mobile1','mobile2','landline','email','status','tin_no','lock','notes',
                        'post_date','user_id'];

  public function user()
  {
      return $this->belongsTo("App\User");
  }                      

}
