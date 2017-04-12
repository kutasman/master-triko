<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\ShippingType;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Shipping;

class ShippingTest extends TestCase
{
    use DatabaseTransactions;


	public function test_shipping_creation() {

		$shippingType = factory(ShippingType::class)->create();

		$data = [
			'type_id' => 1,
			'meta' => [
				'name' => 'John',
				'warehouse' => 'test address',
			],
		];

		$order = factory(Order::class)->create();
		$shipping = $order->shipping()->create($data);

		$this->assertDatabaseHas('shippings', ['id' => $shipping->id, 'meta' => json_encode($data['meta'])]);

    }

	public function test_shipping_return_meta_attr_as_collection_instance() {

		$shipping = factory(Shipping::class)->create();

		$this->assertTrue($shipping->meta instanceof Collection);

    }
}
