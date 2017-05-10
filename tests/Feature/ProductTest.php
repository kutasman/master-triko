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

    protected $product;

    protected function setUp()
    {
        parent::setUp();

        $this->product = factory(Product::class)->create(['active' => false]);

    }

    public function test_http_product_title_updating()
    {


        $this->assertDatabaseHas('products', ['title' => $this->product->title]);

        $newData = [
            'title' => 'new title',
        ];
        $response = $this->json('PUT', $this->url("products/{$this->product->id}"), $newData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', ['title' => 'new title']);

    }

    public function test_json_product_active_update()
    {
        $response = $this->json('PUT', $this->url("products/{$this->product->id}"), ['active' => true]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['active' => 1, 'id' => $this->product->id]);

    }

    protected function url($action){
        return 'admin/' . $action;
    }
}
