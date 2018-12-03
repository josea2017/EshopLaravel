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
Route::get('products/edit/{id}','ProductController@edit');
Route::post('products/edit/{id}','ProductController@update');
Route::get('products/delete/{id}','ProductController@destroy');
Route::get('categories/delete/{id}','CategoryController@destroy');
Route::get('categories/edit/{id}','CategoryController@edit');
Route::post('categories/edit/{id}','CategoryController@update');

