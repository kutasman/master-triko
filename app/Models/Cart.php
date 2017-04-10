<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Session;

class Cart extends Model {

	protected $fillable = [ 'session_id' ];

	//Relations_____

	public function items() {

		return $this->hasMany(CartItem::class);

	}

	public function order()
	{
		return $this->hasOne(Order::class);
	}

	//Methods

	public function count()
	{

		return $this->items()->count();

	}

	public function hasItems() {

		return !! $this->count();

	}

	public function createItem(Product $product, $modificatorsFormData){

		$cartItem = $this->items()->create(['data' => $this->retrieveFullCartItemData($product->id, $modificatorsFormData)]);

		return $cartItem;

	}

	public function removeItem($item){
		if ($item instanceof CartItem){
			$item->delete();
		} else {
			CartItem::find($item)->delete();
		}
	}

	public function total()
	{
		$total = 0;
		if ($this->hasItems())
		{
			foreach ($this->items as $item){
				$total += $item->total();
			}
		}
		return $total;
	}

	//Helpers

	protected function retrieveFullCartItemData($product_id, $mod_data){



		$product = Product::findOrFail($product_id);

		$product->load(['images' => function($query){

			$query->limit(1);

		}]);

		$modificators = new Collection();

		//Iterate throw item modificators

		if (!empty($mod_data)) {

			foreach ( $mod_data as $modType => $modData ) {

				$modData = collect( $modData );

				$modData->each( function ( $values, $modId ) use ( &$modificators, $modType ) {

					$modificator = Modificator::find( $modId );

					if ( 'text' != $modType ) {

						$modificator->load( [
							'options' => function ( $query ) use ( $values ) {
								$query->whereIn( 'id', collect( $values ) );
							}
						] );

					} else {

						$modificator->value = $values;

					}

					$modificators->push( $modificator );

				} );
			}
		}

		$product->user_modifications = $modificators->toArray();

		return $product->toArray();

	}

}
