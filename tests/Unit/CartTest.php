<?php

namespace Tests\Unit;

use App\Models\Modificator;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Cart;
use App\Models\CartItem;

class CartTest extends TestCase
{
    public function testCartConsistsItems()
    {
    	$product = $this->createProductWithModificators();


	    $item = new CartItem($product->id,$this->getModFormData($product->modificators) );

	    $cart = new Cart();

	    $cart->add($item);

    	$this->assertEquals(1, $cart->count());
    	$this->assertEquals(1, count($cart->items()));
    }


	protected function createProductWithModificators()
	{
		$product = factory(Product::class)->create();

		$product->modificators()->saveMany(factory(Modificator::class,2)->create());

		return $product;
	}

	protected function getModFormData($modificators)
	{
		$data = [];

		foreach ($modificators as $mod){

			if ('text' == $mod->type)
			{
				$data['text'] = [$mod->id => 'test text'];
			} else {
				$data[$mod->type] = [$mod->id => rand(1,5)];
			}
		}

		return $data;
	}
}
