<?php

namespace Tests\Unit;

use App\Models\PaymentType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaymentTypeTest extends TestCase
{
	public function test_payment_type_creation() {
		$paymentType = PaymentType::create([
			'name' => 'pay name',
			'slug' => 'pay_slug',
			'description' => 'pay_desc',
		]);

		$this->assertDatabaseHas('payment_types', ['id' => $paymentType->id, 'slug' => 'pay_slug']);
    }
}
