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

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Auth::routes();

//Route::get('/catalog', 'CatalogController@catalog')->name('catalog');

Route::group(['prefix' => 'craft'], function (){
	Route::get('/general', 'CraftController@general')->name('craft.general');
	Route::post('/models', 'CraftController@models')->name('craft.models');
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function (){
	Route::get('/', 'AdminController@index');
	Route::resource('products', 'ProductController',['except' => ['show']]);
	Route::post('products/{product}/add-image', 'ProductController@addImage')->name('products.add_image');
	Route::delete('/products/{product}/delete-image/{image}', 'ProductController@removeImage')->name('products.delete-image');
	Route::resource('attributes', 'AttributesController', ['except' => ['show']]);
	Route::resource('images', 'ImagesController', ['except' => ['show']]);
	//Route::post('')
});