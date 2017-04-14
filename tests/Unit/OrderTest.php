<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\ShippingType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    protected $shippingType;

    protected function setUp() {
	    parent::setUp();

	    $this->cart = factory(Cart::class)->create();

		$this->product = factory(Product::class)->create();

	    $this->cartItem = $this->cart->createItem($this->product, null);

	    $this->shippingType = factory(ShippingType::class)->create();

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
		    'status_id' => 1,
	    ];

		$order = $this->cart->order()->create($data);

		$this->assertDatabaseHas('orders', ['id' => $order->id]);
    }


	public function test_add_shipping_to_order() {

    	$order = factory(Order::class)->create();

    	$shippingData = [
    		'type_id' => 1,
    		'meta' => [
				'first_name' => 'John',
				'last_name' => 'Smith',
				'phone' => '4683647239648',
		        ]
			];


    	$shipping = $order->shipping()->create($shippingData);

    	$this->assertDatabaseHas('shippings', [
    		'id'=> $shipping->id,
		    'order_id' => $order->id,
		    'meta' => json_encode($shippingData['meta']),
	    ]);
    }

	public function test_order_can_mark_cart_as_ordered() {

		$cart = factory(Cart::class)->create();

    	$order = factory(Order::class)->create(['cart_id' => $cart->id]);

    	$this->assertDatabaseHas('carts', ['id' => $cart->id, 'ordered' => 0]);

    	$order->markCartAsOrdered();

		$this->assertDatabaseHas('carts', ['id' => $cart->id, 'ordered' => 1]);

    }

	public function test_set_order_status_by_id() {

		$status = factory(OrderStatus::class)->create();
		$confirmedStatus = factory(OrderStatus::class)->create(['slug' => 'confirmed']);


		$order = factory(Order::class)->create(['status_id' => $status->id]);

		$this->assertDatabaseHas('orders', ['id' => $order->id, 'status_id' => $status->id]);

		$order->setStatusById($confirmedStatus->id)->save();

		$this->assertDatabaseHas('orders', ['id' => $order->id, 'status_id' => $confirmedStatus->id]);

    }

	public function test_set_order_status_by_slug() {

		$status = factory(OrderStatus::class)->create();
		$confirmedStatus = factory(OrderStatus::class)->create(['slug' => 'confirmed']);



		$order = factory(Order::class)->create(['status_id' => $status->id]);

		$this->assertDatabaseHas('orders', ['id' => $order->id, 'status_id' => $status->id]);

		$order->setStatusBySlug('confirmed')->save();

		$this->assertDatabaseHas('orders', ['id' => $order->id, 'status_id' => $confirmedStatus->id]);

    }

	public function test_set_order_status() {

    	$status = factory(OrderStatus::class)->create();
    	$confirmedStatus = factory(OrderStatus::class)->create(['slug' => 'confirmed']);


    	$order = factory(Order::class)->create(['status_id' => $status->id]);

    	$this->assertDatabaseHas('orders', ['id' => $order->id, 'status_id' => $status->id]);

    	$order->setStatus('confirmed')->save();

    	$this->assertDatabaseHas('orders', ['id' => $order->id, 'status_id' => $confirmedStatus->id]);

    }

	public function test_retrieve_status_slug() {

		$status = factory(OrderStatus::class)->create(['slug' => 'test']);

		$order = factory(Order::class)->create(['status_id' => $status->id]);

		$this->assertEquals($status->slug, $order->getStatusSlug());

	}

	public function test_set_wrong_status() {

		$order = factory(Order::class)->create();

		$this->expectException(ModelNotFoundException::class);

		$order->setStatus('wrong')->save();

	}
}
