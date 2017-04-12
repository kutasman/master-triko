<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *attribute_types
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Cart::class, function ($app){

        	$cart = Cart::firstOrNew(['id' => \Session::get('cart')]);
        	$cart->session = \Session::getId();
        	$cart->save();
        	\Session::put('cart', $cart->id);
        	return $cart;
        });

	    // Using Closure based composers...
	    \View::composer('common.nav', function ($view) {
	    	$cart = $this->app->make(Cart::class);
		    $view->with(['cart' => $cart]);
	    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
