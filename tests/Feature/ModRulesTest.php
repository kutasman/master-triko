<?php

namespace Tests\Feature;

use App\Models\Modificator;
use App\Models\ModRule;
use App\Models\Product;
use App\Models\User;
use Tests\Helpers\Traits\UrlCreator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModRulesTest extends TestCase
{

    use DatabaseTransactions;
    use UrlCreator;

    protected $baseUrl = 'admin/';
    protected $modificator;
    protected $targetModificator;
    protected $product;


    protected function setUp()
    {
        parent::setUp();

        $this->product = factory(Product::class)->create();
        $this->modificator = factory(Modificator::class)->create(['type' => 'radio']);
        $this->targetModificator = factory(Modificator::class)->create(['type' => 'radio']);

        $this->product->modificators()->attach([$this->modificator->id,$this->targetModificator->id]);

        $this->modificator->options()->create([
            'name' => 'no',
            'rise' => 0,
        ]);

        $this->actingAs(factory(User::class)->create(['email' => 'evgenij.kutas@gmail.com']));

    }

    public function test_http_mod_rule_creation()
    {
        $data = [
            'toggle_id' => $this->modificator->id,
            'toggle_option_id' => $this->modificator->options->first()->id,
            'target_id' => $this->targetModificator->id,
            'action' => 'disable',
        ];

        $response = $this->json('POST', $this->url("products/{$this->product->id}/mod-rules"), $data);

        $response->assertStatus(200);
        $response->assertJson($data);
        $this->assertDatabaseHas('mod_rules', ['target_id' => $this->targetModificator->id, 'action' => 'disable']);

    }

    public function test_http_destroy_rule()
    {
        $data = [
            'toggle_id' => $this->modificator->id,
            'toggle_option_id' => $this->modificator->options->first()->id,
            'target_id' => $this->targetModificator->id,
            'action' => 'disable',
        ];

        $modRule = factory(ModRule::class)->create($data);


        $response = $this->json('DELETE', $this->url("mod-rules/{$modRule->id}"));

        $response->assertStatus(200);

        $this->assertDatabaseMissing('mod_rules', ['id' => $modRule->id]);

    }

}
