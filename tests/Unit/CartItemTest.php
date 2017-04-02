<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Modificator;
use App\Models\ModOption;
use App\Models\Product;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartItemTest extends TestCase
{
	use DatabaseTransactions;


	public function test_cart_item_creation() {

		$product = $this->createProductWithModificators();

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($product, $this->getModFormData($product->modificators));

		$this->assertDatabaseHas('cart_items', ['id' => $cartItem->id]);

	}

	public function test_it_extract_data_with_get_method() {

		$product = $this->createProductWithModificators();

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($product, $this->getModFormData($product->modificators));

		$this->assertEquals($product->title, $cartItem->data('title'));
	}

	public function test_it_retrieve_data_string_as_string_and_arrays_as_collections()
	{
		$product = $this->createProductWithModificators();

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($product, $this->getModFormData($product->modificators));

		$this->assertEquals($product->title, $cartItem->data('title'));

		$this->assertTrue($cartItem->data('user_modifications') instanceof Collection);
	}

	public function test_item_total_price_calculating() {

		$option = ['name' => 'option for calculating', 'rise' => 222];

		$product = $this->createProductWithModificators($option);

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($product, $this->getModFormData($product->modificators));


		$expectedTotal = $product->price + $option['rise'];

		$this->assertEquals($expectedTotal, $cartItem->total());

	}

	public function test_item_retrieve_image(){

		$product = $this->createProductWithModificators();

		$image = $product->images()->create(['path' => 'test.jpg']);

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($product, $this->getModFormData($product->modificators));

		$this->assertEquals($image->path, $cartItem->imageSrc());
	}


	//Helpers____________________________________________


	/**
	 * @param array $option Default value for option
	 *
	 * @return mixed
	 */
	protected function createProductWithModificators(array $option = [ 'name' => 'test', 'rise' =>10])
	{

		$product = factory(Product::class)->create();

		$mod_select = factory(Modificator::class)->create()->each(function ($m) use ($option){
			$m->options()->create($option);
		});

		$mod_text = factory(Modificator::class)->create(['type' => 'text']);

		$product->modificators()->attach($mod_select);
		$product->modificators()->attach($mod_text);

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
				$data[$mod->type] = [$mod->id => $mod->options()->first()->id];
			}
		}

		return $data;
	}

}
