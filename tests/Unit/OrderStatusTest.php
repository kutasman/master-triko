<?php

namespace Tests\Unit;

use App\Models\OrderStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderStatusTest extends TestCase
{
	use DatabaseTransactions;

	public function test_order_status_creation() {
		$status = OrderStatus::create([
			'name' => 'New',
			'description' => 'Order just created',
			'slug' => 'new',
		]);

		$this->assertDatabaseHas('order_statuses', ['id' => $status->id, 'slug' => 'new']);

   }
}
