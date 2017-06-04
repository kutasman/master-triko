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



}
