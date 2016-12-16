<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class StockOut extends Model
{
    protected $connection = 'domain';
    protected $table = 'stockout';
    protected $primaryKey = 'stockout_id';
    protected $fillable = ['supplier_id','branch_id','series_id','notes','encode',
    						'post_date','user_id','status'];
    public $timestamps = false;

    public static $rules =['supplier_id' => 'required',
    						'branch_id' => 'required',
    						]; 

    public function items()
    {
    	return $this->hasMany('App\Models\StockOutItem','stockout_id','stockout_id');
    }						

    public static function onhand($prod_id,$branch)
    {
    	$available = DB::select("SELECT qty FROM view_product_onhand_per_branch
        				WHERE product_id = $prod_id AND branch_id = $branch");
    	
    	if(!is_null($available[0]->qty))
    		return $available[0]->qty;

    	return 0;
    }

    public static function book($prod_id,$branch)
    {
    	$book = DB::select("SELECT SUM(pbi.quantity) AS qty FROM `product_book_item` pbi
							LEFT JOIN `product_book` pb ON pbi.product_book_id = pb.product_book_id
							WHERE pbi.product_id =$prod_id AND pb.branch_id = $branch");
    	
    	if(!is_null($book[0]->qty))
    		return $book[0]->qty;

    	return 0;
    }

    public static function stockout($prod_id,$branch)
    {
    	$stockout = DB::select("SELECT SUM(si.quantity) AS qty FROM `stockout_item` si
							LEFT JOIN `stockout` s ON si.stockout_id = s.stockout_id
							WHERE si.product_id =$prod_id AND s.branch_id = $branch
							AND status IN ['PENDING','ONGOING']");
    	
    	if(!is_null($stockout[0]->qty))
    		return $stockout[0]->qty;

    	return 0;
    }	

    public static function transfer($prod_id,$branch)
    {
    	$transfer = DB::select("SELECT SUM(sti.quantity) AS qty FROM `stock_transfer_item` sti
							LEFT JOIN `stock_transfer` st ON sti.transfer_id = st.transfer_id
							WHERE sti.product_id =$prod_id AND st.orig_branch_id = $branch");
    	
    	if(!is_null($transfer[0]->qty))
    		return $transfer[0]->qty;

    	return 0;
    }
    public static function adjust_out($prod_id,$branch)
    {
    	$adjust = DB::select("SELECT SUM(saoi.quantity) AS qty FROM `stock_adj_out_item` saoi
							LEFT JOIN `stock_adj_out` st ON saoi.stock_adj_out_id = st.stock_adj_out_id
							WHERE saoi.product_id =$prod_id AND st.branch_id = $branch");
    	
    	if(!is_null($adjust[0]->qty))
    		return $adjust[0]->qty;

    	return 0;
    }

    public static function available($prod_id,$branch)
    {
    	$onhand = self::onhand($prod_id,$branch);
        $book  = self::book($prod_id,$branch);
        $stockout = self::stockout($prod_id,$branch);
        $transfer = self::transfer($prod_id,$branch);
        $adjust_out = self::adjust_out($prod_id,$branch);
        return ($onhand - ($book + $stockout + $transfer + $adjust_out));
    }	

    public function approval()
    {
        return $this->morphOne('App\Models\Approval', 'approvalable');
    }
							
    					
}
