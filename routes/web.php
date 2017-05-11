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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::match(['get', 'post'],'factory/{factory}', 'FactoryController@index')->name('factory');

Route::post('cart/{product}', 'CartController@addProduct')->name('cart.add_item');
Route::get('cart', 'CartController@show')->name('cart.show');
Route::delete('cart/{item}', 'CartController@removeItem')->name('cart.remove_item');

Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('checkout/validate/contacts', 'CheckoutController@validateContacts');
Route::post('checkout/validate/shipping', 'CheckoutController@validateShipping');
Route::post('checkout/validate/payment', 'CheckoutController@validatePayment');
Route::post('checkout/confirm-order', 'CheckoutController@confirmOrder');
Route::get('nova-poshta-cities', 'CheckoutController@getNPCities');
Route::put('nova-poshta-cities', 'CheckoutController@updateNPCities');


Auth::routes();


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function (){
	Route::get('/', 'AdminController@index');

	//Products
	Route::resource('products', 'ProductController', ['except' => ['show']]);
	Route::post('products/{product}/add-image', 'ProductController@addImage')->name('products.add_image');
	Route::delete('/products/{product}/delete-image/{image}', 'ProductController@removeImage')->name('products.delete-image');
	Route::post('products/{product}/create-modificator', 'ProductController@createModificator')->name('products.create_modificator');
	Route::post('products/{product}/sync-modificators', 'ProductController@syncModificators')->name('products.sync_modificators');
	Route::delete('products/{product}/detach-modificator', 'ProductController@detachModificator')->name('products.detach_modificator');

	Route::resource('images', 'ImagesController', ['except' => ['show']]);
	Route::resource('categories', 'CategoriesController', ['except' => 'show']);
	Route::resource('factories', 'FactoriesController');


	//Modificators
	Route::resource('modificators', 'ModificatorsController');
    Route::get('modificators/{modificator}/options', 'ModificatorsController@options')->name('modificators.options');

    Route::get('factories/{factory}/modificators', 'FactoriesController@getFactoryModificators')->name('factories.get_modificators');
    Route::post('factories/{factory}/modificator', 'FactoriesController@createModificator')->name('factories.create_modificator');

    //ModOptions
    Route::resource('mod-options', 'ModOptionsController', ['only' => ['destroy', 'update']]);
	Route::post('modificators/{modificator}/mod-options', 'ModOptionsController@store')->name('mod-options.store');

	//Route::post('modificators/{modificator}/option', 'ModificatorsController@createOptions')->name('modificators.create_option');
	Route::delete('/modificators/{modificator}/detach', 'ModificatorsController@detach')->name('modificators.detach');

	Route::resource('shipping-types', 'ShippingTypesController');
	Route::get('shipping-types/all', 'ShippingTypesController@all')->name('shipping-types.all');

	Route::resource('payment-types', 'PaymentTypesController');
	Route::resource('order-statuses', 'OrderStatusesController');
	Route::resource('orders', 'OrdersController');
});
