<?php

namespace Tests\Unit;

use App\Models\Modificator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModificatorTest extends TestCase
{

    use DatabaseTransactions;

    protected $modificator;

    protected function setUp()
    {
        parent::setUp();

        $this->modificator = factory(Modificator::class)->create();
    }

    public function test_check_is_mod_toggle()
    {
        $this->assertFalse($this->modificator->toggle);

        $this->modificator->update(['toggle' => true]);

        $this->assertTrue($this->modificator->toggle);
    }


}
