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
	Route::post("stockin-float/save","StockinController@stockFloatSave");
	Route::post("stockin-float/update","StockinController@stockFloatUpdate");
	
	Route::resource('stockin','StockinController');

	Route::get('clusters/ng-cluster-list','ClusterController@cluster_list');
	Route::resource('clusters','ClusterController');

	Route::get('product-group/ng-pgroup-list','ProductGroupController@group_list');
	Route::resource('product-group','ProductGroupController');

	Route::get('product-storage/ng-storage-list','ProductStorageController@storage_list');
	Route::resource('product-storage','ProductStorageController');

	Route::get('header/task','HeaderController@task');
});


// });




// Auth::routes();

// Route::get('/home', 'HomeController@index');
