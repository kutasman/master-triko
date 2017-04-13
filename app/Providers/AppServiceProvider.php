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

        	$cart = Cart::firstOrNew(['session' => \Session::get('cart.session'),'id' => \Session::get('cart.id') ]);
        	$cart->session = \Session::getId();
        	$cart->save();
        	\Session::put('cart.session', $cart->session);
        	\Session::put('cart.id', $cart->id);
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
