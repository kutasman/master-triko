<?php

namespace Tests\Unit;

use App\Models\ModOption;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModOptionTest extends TestCase
{
    public function test_mod_option_can_be_default()
    {
        $modOption = factory(ModOption::class)->create();

        $this->assertFalse($modOption->default);

        $modOption->update(['default' => true]);

        $this->assertTrue($modOption->default);
    }
}
