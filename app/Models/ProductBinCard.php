<?php

namespace App\Models;
use App\Models\ProductBinCard;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use DB;
class ProductBinCard extends Model
{
    protected $connection = 'domain';
    protected $table ='product_bincard';
    protected $primaryKey = 'sequence_id';
    protected $fillable = ['product_id','branch_id','type','reference_id','price','quantity'];

    public $timestamps = false;


    public static function insert($list)
    {
    	
    	foreach ($list as $val) { 
    		$product_onHand = DB::table('view_product_onhand_per_branch')
    							->where('branch_id',$val->branch_id)
    							->where('product_id',$val->product_id)
    							->first();
    						  						
    		$avg_cost_price = $val->cost_price;

    		if(!is_null($product_onHand) && !empty($product_onHand))
    		{
    			$t_cost = $product_onHand->$value + ($val->quantity * $val->cost_price);
    			$t_quantity = $product_onHand->$value + $val->quantity ;
    			$avg_cost_price = $t_cost / $t_quantity;
    		}

    		$product = Product::find($val->product_id);
    		$product->avg_cost_price = 	$avg_cost_price;
    		$product->save();	

    		$pci = ProductBinCard::firstOrNew([
    					'product_id'=> $val->product_id,
    					'branch_id' => $val->branch_id,
    					'price' => $val->cost_price,
    					'reference_id'=> $val->stockin_id,
    					'type'=> 'STI']);
    		if ($pci->exists) 
    		{    			
    			$pci->quantity += $val->quantity;
    		}else{    			
    			$pci->quantity = $val->quantity;
    		}	
    		
    		$pci->save();
    	}
    }
}
