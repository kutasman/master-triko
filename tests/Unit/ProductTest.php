<?php

namespace Tests\Unit;

use App\Models\Modificator;
use App\Models\ModOption;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    protected $product;

    protected function setUp()
    {
        parent::setUp();

        $this->product = Product::create([
            'title' => 'title',
            'price' => 20,
            'active' => false,
            'factory_id' => 1,
        ]);
    }

    public function test_product_creation()
    {
        $this->assertDatabaseHas('products', ['title' => 'title', 'active' => 0]);
    }

    public function test_create_rule_method()
    {
        $modRule = $this->product->createRule([
            'toggle_id' => factory(Modificator::class)->create()->id,
            'toggle_option_id' => factory(ModOption::class)->create()->id,
            'target_id' => factory(Modificator::class)->create()->id,
            'action' => 'disable',
        ]);

        $this->assertDatabaseHas('mod_rules', ['id' => $modRule->id]);
    }

}
