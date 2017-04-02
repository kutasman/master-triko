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


	protected function setUp() {
		parent::setUp();

		$this->product = $this->createProductWithModificators();

	}

	public function test_cart_creation() {

		$cart = Cart::create(['session_id' => \Session::getId()]);

		$this->assertDatabaseHas('carts', ['session_id' => \Session::getId()]);
	}

	public function test_cart_can_create_cart_item()
	{

		$modFarmData = $this->getModFormData($this->product->modificators);

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($this->product, $modFarmData);


		$this->assertDatabaseHas('cart_items', ['id' => $cartItem->id]);

	}

	public function test_cart_can_have_items()
	{
		$product1 = $this->createProductWithModificators();
		$product2 = $this->createProductWithModificators();

		$modFarmData1 = $this->getModFormData($product1->modificators);
		$modFarmData2 = $this->getModFormData($product2->modificators);

		$cart = factory(Cart::class)->create();

		$cart->createItem($product1, $modFarmData1);
		$cart->createItem($product2, $modFarmData2);

		$this->assertEquals(2, $cart->items->count());
	}

	public function test_cart_can_count_items()
	{



		$modFarmData = $this->getModFormData($this->product->modificators);

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($this->product, $modFarmData);

		$this->assertEquals(1, $cart->count());

	}

	public function test_cart_can_remove_item()
	{

		$modFarmData = $this->getModFormData($this->product->modificators);

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($this->product, $modFarmData);

		$this->assertDatabaseHas('cart_items', ['id' => $cartItem->id]);

		$cart->removeItem($cartItem);

		$this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
	}


	public function test_create_item_without_modificators() {


		$image = $this->product->images()->create(['path' => 'test.jpg']);

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($this->product, null);

		$this->assertDatabaseHas('cart_items', ['id' => $cartItem->id]);
	}

    //Helpers

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
