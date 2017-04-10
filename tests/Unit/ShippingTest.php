<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Shipping;

class ShippingTest extends TestCase
{
    use DatabaseTransactions;

	public function test_shipping_creation_() {

		$data = [
			'type_id' => 1,
			'meta' => [
				'name' => 'John',
				'warehouse' => 'test address',
			],
		];
		$shipping = Shipping::create($data);

		$this->assertDatabaseHas('shippings', $data);

    }
}
