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

Route::group(['prefix' => 'craft'], function (){
	Route::get('/general', 'CraftController@general')->name('craft.general');
	Route::post('/models', 'CraftController@models')->name('craft.models');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function (){
	Route::get('/', 'AdminController@index');
	Route::resource('products', 'ProductController',['only' => ['index','create' ,'store']]);
});