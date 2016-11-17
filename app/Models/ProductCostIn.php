<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCostIn extends Model
{
    protected $connection = 'domain';
    protected $table ='product_cost_in';
    protected $primaryKey = 'cost_in_id';
    protected $fillable = ['branch_id','type','reference_id','cost_price','quantity'];

    public $timestamps = false;


    public static function insert($list)
    {
    	$list = $this->group_product($list);
    }

    private function group_product($list)
    {
    	$result = [];
    	foreach ($list as $val) {
    		if(!empty($result))
    		{
    			$found = false;
    			foreach ($result as $k) {
    				if($k->product_it == $val->product_id){
    					$k->quantity = $val->quantity;
    					$found = true;
    					break;
    				}   				

    			}
    			if(!$found)
    				array_push($result,$val);
    		}else{
    			array_push($result,$val);
    		}
    	}
    	return $result;
    }
}
