<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    protected $cart;

    protected $product;

    protected $cartItem;

    protected $shipping;

    protected function setUp() {
	    parent::setUp();

	    $this->cart = factory(Cart::class)->create();

		$this->product = factory(Product::class)->create();

	    $this->cartItem = $this->cart->createItem($this->product, null);

	    $this->shipping = factory(Shipping::class)->create(['type_id' => 1]);

    }


    public function test_order_creation()
    {

    	$data = [
		    'first_name' => 'name',
		    'last_name' => 'last name',
		    'email' => 'customer@email.com',
		    'phone' => '380654568988',
		    'comment' => 'some texts',
	    ];

		$order = $this->cart->order()->create($data);

		$this->assertDatabaseHas('orders', ['id' => $order->id]);
    }


    
}
