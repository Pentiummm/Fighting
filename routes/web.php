<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Example Routes
Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});
Route::view('/examples/plugin-helper', 'examples.plugin_helper');
Route::view('/examples/plugin-init', 'examples.plugin_init');
Route::view('/examples/blank', 'examples.blank');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::match(['get', 'post'], '/admin', 'AdminController@login');

Route::group(['middleware' => ['auth']], function(){
  Route::get('/logout', 'AdminController@logout');
  Route::get('/admin/dashboard', 'AdminController@dashboard');
  // Category
  Route::get('/admin/allcategory', 'CategoryController@allCategory');
  Route::match(['get', 'post'], '/admin/addcategory', 'CategoryController@addCategory');
  Route::match(['get', 'post'], '/admin/editcategory/{id}', 'CategoryController@editCategory');
  Route::match(['get', 'post'], '/admin/deletecategory/{id}', 'CategoryController@deleteCategory');
  // Product
  Route::get('/admin/allproduct', 'ProductsController@allProduct');
  Route::match(['get', 'post'], '/admin/addproduct', 'ProductsController@addProduct');
  Route::match(['get', 'post'], '/admin/editproduct/{id}', 'ProductsController@editProduct');
  Route::get('/admin/deleteproductimage/{id}', 'ProductsController@deleteProductImage');
  Route::match(['get', 'post'], '/admin/deleteproduct/{id}', 'ProductsController@deleteProduct');
});

// API
Route::get('/api/products', 'ProductsController@index');
