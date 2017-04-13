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
	use DatabaseTransactions;


	protected $product;
	protected $cart;


	protected function setUp() {
		parent::setUp();

		$this->product = $this->createProductWithModificators();
		$this->cart = factory(Cart::class)->create();

	}

	public function test_cart_creation() {

		$this->assertDatabaseHas('carts', ['id' => $this->cart->id]);
	}

	public function test_cart_can_create_cart_item()
	{

		$modFarmData = $this->getModFormData($this->product->modificators);


		$cartItem = $this->cart->createItem($this->product, $modFarmData);


		$this->assertDatabaseHas('cart_items', ['id' => $cartItem->id]);

	}

	public function test_cart_can_have_items()
	{
		$product1 = $this->createProductWithModificators();
		$product2 = $this->createProductWithModificators();

		$modFarmData1 = $this->getModFormData($product1->modificators);
		$modFarmData2 = $this->getModFormData($product2->modificators);


		$this->cart->createItem($product1, $modFarmData1);
		$this->cart->createItem($product2, $modFarmData2);

		$this->assertEquals(2, $this->cart->items->count());
	}

	public function test_cart_can_count_items()
	{

		$modFormData = $this->getModFormData($this->product->modificators);


		$cartItem = $this->cart->createItem($this->product, $modFormData);

		$this->assertEquals(1, $this->cart->count());

	}

	public function test_cart_can_remove_item()
	{

		$modFarmData = $this->getModFormData($this->product->modificators);


		$cartItem = $this->cart->createItem($this->product, $modFarmData);

		$this->assertDatabaseHas('cart_items', ['id' => $cartItem->id]);

		$this->cart->removeItem($cartItem);

		$this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
	}


	public function test_create_item_without_modificators() {


		$image = $this->product->images()->create(['path' => 'test.jpg']);


		$cartItem = $this->cart->createItem($this->product, null);

		$this->assertDatabaseHas('cart_items', ['id' => $cartItem->id]);
	}

	public function test_can_know_full_or_empty_cart_is() {


		$this->assertFalse($this->cart->hasItems());

		$item = $this->cart->createItem($this->product, null);

		$this->assertTrue($this->cart->hasItems());

	}

	public function test_cart_total_price_calculating(){


		$this->cart->createItem($this->product, null);
		$this->cart->createItem($this->product, $this->getModFormData($this->product->modificators)); // + 10 modificator rise

		$this->assertEquals($this->product->price*2+10 , $this->cart->total());

	}

    //Helpers

	protected function createProductWithModificators(array $option = [ 'name' => 'test', 'rise' =>10])
	{
		$options = $option;
		$product = factory(Product::class)->create();

		$mod_select = factory(Modificator::class)->create()->each(function ($m) use ($options){
			if ( ! empty($options)){
				$m->options()->create($options);
			}
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
