<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{

    use DatabaseTransactions;
    use WithoutMiddleware;

    protected function setUp()
    {
        parent::setUp();

    }

    public function test_http_product_title_updating()
    {

        $product = factory(Product::class)->create();

        $this->assertDatabaseHas('products', ['title' => $product->title]);

        $newData = [
            'title' => 'new title',
        ];
        $response = $this->json('PUT', $this->url("products/{$product->id}"), $newData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', ['title' => 'new title']);

    }

    protected function url($action){
        return 'admin/' . $action;
    }
}
