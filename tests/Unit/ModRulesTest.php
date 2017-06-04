<?php

namespace Tests\Unit;

use App\Models\Modificator;
use App\Models\ModRule;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModRulesTest extends TestCase
{
    use DatabaseTransactions;

    protected $product;
    protected $modificator;
    protected $targetModificator;

    protected function setUp()
    {
        parent::setUp();

        $this->product = factory(Product::class)->create();
        $this->modificator = factory(Modificator::class)->create(['type' => 'radio']);
        $this->targetModificator = factory(Modificator::class)->create(['type' => 'radio']);
        $this->product->modificators()->attach([$this->modificator->id, $this->targetModificator->id]);

        $this->modificator->options()->create([
            'name' => 'yes',
            'rise' => 10,
        ]);
    }


    public function test_mod_rule_creation()
    {

        $rule = $this->product->mod_rules()->create([
            'toggle_id' => $this->modificator->id,
            'toggle_option_id' => $this->modificator->options->first()->id,
            'target_id' => $this->targetModificator->id,
            'action' => 'disable',
        ]);

        $this->assertDatabaseHas('mod_rules',['id' => $rule->id]);


    }
}
