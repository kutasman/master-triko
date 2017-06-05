<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Contracts\CartInterface;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CartInterface::class,
            Cart::class
        );
    }
}
