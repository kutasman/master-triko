<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Modificator;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartTest extends TestCase
{

use DatabaseTransactions;


	public function testEmptyCart()
    {



    	$this->get('/cart')
		    ->assertSee('Cart is empty');
    }
}
