<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'web'], function () {
	Route::get('logout','Auth\LoginController@logout');
	Auth::routes();
	Route::get('/', 'HomeController@index');

	//Category
	Route::get('category/ng-cat-list','CategoryController@category_list');
	Route::resource('category','CategoryController');

	//Branches
	Route::get('branches/ng-branch-list','BranchController@branch_list');
	Route::resource('branches','BranchController');

	//Products
	Route::get('products-regular-list','ProductController@product_list');
	Route::get('products/search/{id}/{param}','ProductController@search');
	Route::post('product/multi_search','ProductController@multi_search');
	
	Route::resource('products-regular','ProductController');

	Route::get('acc_levels/ng-acc_levels-list','AccountLevelController@level_list');
	Route::resource('acc_levels','AccountLevelController');

	Route::get('discounting/ng-discount-list','DiscountController@discount_list');
	Route::resource('discounting','DiscountController');

	Route::get('suppliers/ng-supplier-list','SupplierController@supplier_list');
	Route::resource('suppliers','SupplierController');

	Route::get('stockin/ng-stockin-list','StockinController@stockinList');
	Route::post('stockin-float','StockinController@stockFloat');
	Route::post('stockin-float/items','StockinController@stockFloatItems');
	Route::get('stockin/search','StockinController@search');
	Route::post("stockin-items-remove/{id}",'StockinController@removeItems');
	Route::get("stockin-float/cancel","StockinController@cancel");
	Route::get("stockin/pdf/{id}","StockinController@stockin_pdf");
	Route::post("stockin-float/save","StockinController@stockFloatSave");
	Route::post("stockin-float/update","StockinController@stockFloatUpdate");
	
	Route::resource('stockin','StockinController');

	Route::get("stockout/pdf/{id}","StockOutController@pdf");
	Route::post('stockout/multi_search','StockOutController@postSearch');
	Route::post('stockout-float/items','StockOutController@saveItems');
	Route::post('stockout/search','StockOutController@postSingleSearch');
	Route::post('stockout-items-remove','StockOutController@removeItems');
	Route::post('stockout-float/save','StockOutController@save');
	Route::get('stockout/search','StockOutController@search');
	Route::get('stockout/ng-stockout-list','StockOutController@stockoutList');
	Route::post('stockout-float','StockOutController@stockoutFloat');
	Route::resource('stockout','StockOutController');

	Route::get('transfer-float/cancel','TransferController@cancel');
	Route::post("transfer-float/save",'TransferController@save');
	Route::post("transfer-items-remove/{id}",'TransferController@removeItems');
	Route::post('transfer/singleSearch','TransferController@postSingleSearch');
	Route::post('transfer/items','TransferController@saveItems');
	Route::get('transfer/search','TransferController@search');
	Route::post('transfer/multi_search','TransferController@postSearch');
	Route::get('transfer/ng-transfer-list','TransferController@transferList');	
	Route::post('transfer-float','TransferController@transferFloat');
	Route::resource('transfer','TransferController');

	Route::get('clusters/ng-cluster-list','ClusterController@cluster_list');
	Route::resource('clusters','ClusterController');

	Route::get('product-group/ng-pgroup-list','ProductGroupController@group_list');
	Route::resource('product-group','ProductGroupController');

	Route::get('product-storage/ng-storage-list','ProductStorageController@storage_list');
	Route::resource('product-storage','ProductStorageController');

	Route::get('approvals/ng-approve-list','ApprovalController@approve_list');
	Route::get('approvals/notes','ApprovalController@notes');
	Route::post('approvals/update/{status}/{is}','ApprovalController@update');
	Route::resource('approvals','ApprovalController');

	Route::get('journals/ng-journal-list','JournalController@journal_list');
	Route::resource('journals','JournalController');


	Route::get('header/task','HeaderController@task');
});


// });




// Auth::routes();

// Route::get('/home', 'HomeController@index');
