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
	Route::resource('products-regular','ProductController');

	Route::get('acc_levels/ng-acc_levels-list','AccountLevelController@level_list');
	Route::resource('acc_levels','AccountLevelController');

	Route::get('discounting/ng-discount-list','DiscountController@discount_list');
	Route::resource('discounting','DiscountController');

	Route::get('suppliers/ng-supplier-list','SupplierController@discount_list');
	Route::resource('suppliers','SupplierController');
});


// });




// Auth::routes();

// Route::get('/home', 'HomeController@index');
