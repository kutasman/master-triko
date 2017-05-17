<?php

namespace Tests\Feature;

use App\Models\Modificator;
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


    protected function setUp()
    {
        parent::setUp();

        $this->modificator = factory(Modificator::class)->create(['type' => 'radio']);
        $this->targetModificator = factory(Modificator::class)->create(['type' => 'radio']);

        $this->modificator->options()->create([
            'name' => 'no',
            'rise' => 0,
        ]);

        $this->actingAs(factory(User::class)->create(['email' => 'evgenij.kutas@gmail.com']));

    }

    public function test_http_mod_rule_creation()
    {
        $data = [
            'target_id' => $this->targetModificator->id,
            'option_id' => 1,
            'action' => 'disable',
        ];

        $response = $this->json('POST', $this->url("modificators/{$this->modificator->id}/mod-rules"), $data);

        $response->assertStatus(200);
        $response->assertJson($data);
        $this->assertDatabaseHas('mod_rules', ['target_id' => $this->targetModificator->id, 'action' => 'disable']);

    }

}
