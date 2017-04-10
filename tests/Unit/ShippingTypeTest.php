<?php

namespace Tests\Unit;

use App\Models\ShippingType;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShippingTypeTest extends TestCase
{
use DatabaseTransactions;

	public function test_shipping_type_creation() {

		$data = [
			'name' => 'Poshta',
			'description' => 'test',
			'slug' => 'pushta',
			'meta' => [
				'apiKey' => 'vhdkjfhvkjhrlgjhdfkjlgkljfh',
			],
		];

		$shippingType = ShippingType::create($data);

		$this->assertDatabaseHas('shipping_types', ['id' => $shippingType->id, 'meta' => json_encode($data['meta'])]);

	}


	public function test_shipping_type_return_meta_as_collection()
	{

		$shippingType = factory(ShippingType::class)->create();

		$this->assertTrue($shippingType->meta instanceof Collection);

	}
}
