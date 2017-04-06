<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Order;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    protected $cart;

    protected $product;

    protected $cartItem;

    protected function setUp() {
	    parent::setUp();

	    $this->cart = factory(Cart::class)->create();

		$this->product = factory(Product::class)->create();

	    $this->cartItem = $this->cart->createItem($this->product, null);

    }
}
