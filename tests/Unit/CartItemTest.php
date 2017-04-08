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


	protected $product;
	protected $cart;
	protected $cartItem;


	public function setUp() {

		parent::setUp();
		
		$this->product = $this->createProductWithModificators();

		$this->cart = factory(Cart::class)->create();

		$this->cartItem = $this->cart->createItem($this->product, $this->getModFormData($this->product->modificators));

	}

	public function test_cart_item_creation() {

		$cartItem = $this->cart->createItem($this->product, $this->getModFormData($this->product->modificators));

		$this->assertDatabaseHas('cart_items', ['id' => $cartItem->id]);

	}

	public function test_it_extract_data_with_get_method() {

		$cartItem = $this->cart->createItem($this->product, $this->getModFormData($this->product->modificators));

		$this->assertEquals($this->product->title, $cartItem->data('title'));
	}

	public function test_it_retrieve_data_string_as_string_and_arrays_as_collections()
	{
		$cartItem = $this->cart->createItem($this->product, $this->getModFormData($this->product->modificators));

		$this->assertEquals($this->product->title, $cartItem->data('title'));

		$this->assertTrue($cartItem->data('user_modifications') instanceof Collection);
	}

	public function test_item_total_price_calculating() {

		$mods = [ 'name' => 'test', 'rise' =>10];
		$prodWithMods = $this->createProductWithModificators($mods);
		$prodWithoutMods = factory(Product::class)->create();

		$cartItemWithMods    = $this->cart->createItem($prodWithMods, $this->getModFormData($prodWithMods->modificators));
		$cartItemWithoutMods = $this->cart->createItem($prodWithoutMods, null);

		$expectedTotalWithMods = $prodWithMods->price + $mods['rise'];
		$expectedTotalWithoutMods = $prodWithoutMods->price;

		$this->assertEquals($expectedTotalWithMods, $cartItemWithMods->total());
		$this->assertEquals($expectedTotalWithoutMods, $cartItemWithoutMods->total());

	}


	public function test_item_retrieve_image(){


		$image = $this->product->images()->create(['path' => 'test.jpg']);

		$cart = factory(Cart::class)->create();

		$cartItem = $cart->createItem($this->product, $this->getModFormData($this->product->modificators));

		$this->assertEquals($image->path, $cartItem->imageSrc());
	}


	public function test_can_check_does_item_has_user_modifications() {

		$itemWithoutMods = $this->cart->createItem($this->product, null);
		$itemWithMods = $this->cart->createItem($this->product, $this->getModFormData($this->product->modificators));

		$this->assertFalse($itemWithoutMods->hasMods());
		$this->assertTrue($itemWithMods->hasMods());
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
			if ( ! empty($option)){
				$m->options()->create($option);
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