<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $connection = 'domain';
    protected $database = 'domain';//(Session::has('dbname'))?Session::get('dbname'):"sis2";
    protected $table ='branch';
    protected $primaryKey = 'branch_id';
    
    protected $fillable =['business_name','branch_name','addressline1',
    			'addressline2','tin_no','default_credit_limit',
    			'invoice_header1','invoice_header2','invoice_header3','invoice_footer1',
    			'invoice_footer2','invoice_footer3','bir_permit_no','status',
    			'lock','suspended','notes','cluster_id'];

    public static $rules =[    				
    				'branch_name' => 'required|unique:branch,branch_name',
    				'business_name' => 'required',
                    'addressline1' => 'required'

    ]	;	

    public function cluster()
    {
        return $this->belongsTo('App\Models\Cluster','cluster_id','cluster_id');
    }	

}
