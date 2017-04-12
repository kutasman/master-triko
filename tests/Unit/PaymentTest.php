<?php

namespace Tests\Unit;

use App\Models\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaymentTest extends TestCase
{
	use DatabaseTransactions;
	public function test_payment_creation() {
		$order = factory(Order::class)->create();
		$payment = $order->payment()->create(['type' => 'cash']);

		$this->assertDatabaseHas('payments' , ['id' => $payment->id, 'type' => 'cash']);
    }
}
