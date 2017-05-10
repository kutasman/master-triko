<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function test_product_creation()
    {
        $product = Product::create([
            'title' => 'title',
            'price' => 20,
            'active' => false,
            'factory_id' => 1,
        ]);

        $this->assertDatabaseHas('products', ['title' => 'title', 'active' =>0]);
    }

}
