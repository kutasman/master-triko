<?php

namespace App\Models;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CartItem{


	protected $id;
	protected $data = [];

	public function __construct($product_id, array $mod_data) {
		$this->id = count(\Session::get('cart'));
		$this->data = $this->retrieveFullData($product_id, $mod_data);
	}

	public function title()
	{
		return $this->data['title'];
	}

	public function id()
	{
		return $this->id;
	}

	protected function retrieveFullData($product_id, array $mod_data){
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



	public function getData()
	{
		return $this->data;
	}

}
