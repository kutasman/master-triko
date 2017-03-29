<?php

namespace Tests\Feature;

use App\Models\Modificator;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartTest extends TestCase
{

use DatabaseTransactions;

protected $product;


	public function testEmptyCart()
    {
    	$this->get('/cart')
		    ->assertSee('Cart is empty');
    }

    public function testAddItemToCart()
    {
	    $product = factory(Product::class)->create();

    	$this->post('/cart/' . $product->id, [
    		'modificators' => [
    			'text' => ['1'=> 'test text'],
		        'select' => ['2' => '2', '3' => '1'],
		    ]
	    ])->assertSessionHas('cart', [
	    	[
	    		'product_id' => $product->id,
			    'modificators' => [
				    'text' => ['1'=> 'test text'],
				    'select' => ['2' => '2', '3' => '1'],
			    ]
		    ]
	    ]);
    }


    public function testRemoveItemFromCart()
    {
    	$this->withSession([
    		'cart' => [
    			'product_id' => '1',
			    'modificators' => [
				    'text' => ['1'=> 'test text'],
				    'select' => ['2' => '2', '3' => '1'],
			    ]
		    ]
	    ])->delete('/cart/0')
	        ->assertSessionHas('cart', null);
    }


}
