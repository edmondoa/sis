<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $connection = 'domain';
    protected $database = 'domain';//(Session::has('dbname'))?Session::get('dbname'):"sis2";
    protected $table ='branch';

    protected $fillable =['business_name','branch_name','addressline1',
    			'addressline2','tin_no','terminal_type','default_credit_limit',
    			'invoice_header1','invoice_header2','invoice_header3','invoice_footer1',
    			'invoice_footer2','invoice_footer3','bir_permit_no','status','tran_date',
    			'lock','deactivated','notes'];

    public static $rules =[
    				'business_name' => 'required',
    				'branch_name' => 'required',
    				'default_credit_limit' => 'required|numeric|between:0,99999999.99'

    ]	;		

}
