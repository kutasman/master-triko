<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\Helpers\Traits\UrlCreator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{

    use DatabaseTransactions;
    //use WithoutMiddleware;
    use UrlCreator;

    protected $product;

    protected $baseUrl = 'admin/';

    protected function setUp()
    {
        parent::setUp();
        $this->actingAs(factory(User::class)->create(['email' => 'evgenij.kutas@gmail.com']));

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

    public function test_product_http_destroying()
    {

        $response = $this->json('DELETE', $this->url('products/' . $this->product->id));

        $this->assertDatabaseMissing('products', ['id' => $this->product->id]);
    }

}
