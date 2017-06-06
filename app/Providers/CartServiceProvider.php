<?php

namespace App\Providers;

use App\Contracts\Shop\Cart as CartInterface;
use App\Contracts\Shop\CartItemsRepository as CartItemsRepositoryInterface;
use App\Models\Cart;
use App\Repositories\SessionCartItemsRepository;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CartInterface::class,
            Cart::class
        );

        $this->app->bind(
            CartItemsRepositoryInterface::class,
            SessionCartItemsRepository::class
        );
    }
}
