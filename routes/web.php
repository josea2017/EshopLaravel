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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('products', 'ProductController');
Route::resource('cars', 'CarController');
Route::resource('charges', 'ChargeController');
Route::get('charges/show_charge_user/{id_user}','ChargeController@show_charge_user');
Route::get('charges/delete/{id_product}','ChargeController@delete');
Route::post('charges/destroy/{id_product}','ChargeController@destroy');
Route::post('cars/agregar/{id_user}/{id_product}','CarController@agregar');
Route::get('products/edit/{id}','ProductController@edit');
Route::post('products/edit/{id}','ProductController@update');
Route::get('products/delete/{id}','ProductController@destroy');
Route::get('categories/delete/{id}','CategoryController@destroy');
Route::get('categories/edit/{id}','CategoryController@edit');
Route::post('categories/edit/{id}','CategoryController@update');
Route::resource('catalogs', 'CatalogController');
Route::get('catalogs/products_list/{id}','CatalogController@products_list');
Route::get('catalogs/product_detail/{id}','CatalogController@product_detail');

