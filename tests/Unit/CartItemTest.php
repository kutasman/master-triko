<?php

namespace Tests\Unit;

use App\Models\CartItem;
use App\Models\Modificator;
use App\Models\ModOption;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartItemTest extends TestCase
{
	use DatabaseTransactions;

	public function test_it_creation()
	{
		$product = $this->createProductWithModificators();
		$modificators_form_data = $this->getModFormData($product->modificators);

		$cartItem = new CartItem($product->id, $modificators_form_data);

		$this->assertTrue($cartItem instanceof CartItem);

	}


	public function test_cart_item_retrieve_product_data()
	{
		$product = $this->createProductWithModificators();

		$cartItem = new CartItem($product->id, $this->getModFormData($product->modificators));

		$itemData = $cartItem->getData();

		$this->assertEquals($product->title, $itemData['title']);
		$this->assertEquals($product->id, $itemData['id']);
		$this->assertEquals($product->price, $itemData['price']);
		$this->assertEquals($product->factory_id, $itemData['factory_id']);

		foreach ($itemData['user_modifications'] as $mod){
			$expectedMod = $product->modificators()->whereId($mod['id'])->first();
			foreach ( $expectedMod->toArray() as $key => $expectedValue ) {
				if (in_array($key, ['pivot'])){
					continue;
				};
				$this->assertEquals($expectedValue, $mod[$key]);
			};

		}
	}



	//Helpers____________________________________________


	protected function createProductWithModificators()
	{
		$product = factory(Product::class)->create();

		$mod_select = factory(Modificator::class)->create()->each(function ($m){
			$m->options()->create(['name' => 'test', 'rise' =>10]);
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
