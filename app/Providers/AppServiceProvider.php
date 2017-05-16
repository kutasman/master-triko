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
