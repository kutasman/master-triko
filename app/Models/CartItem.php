<?php

namespace App\Models;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model{

	protected $casts = [
		'data' => 'array',
	];

	protected $fillable = ['data'];

	//Mutators_________

	public function getDataAttribute()
	{
		return collect(json_decode($this->attributes['data']));
	}

	public function data( $key = null )
	{
		if (is_null($key)){

			return $this->data;

		} else {

			$value = $this->data->get($key);

			$value = is_array($value) ? collect($value) : $value;

			return $value;
		}
	}


	/**
	 * Calculate Total item price
	 *
	 * @return int
	 */
	public function total()
	{
		$total = $this->data('price');

		if ($this->hasMods()){
			foreach ($this->data('user_modifications') as $mod){
				if ('text' != $mod->type){
					foreach ($mod->options as $option){
						$total += $option->rise;
					}
				}
			}
		}

		return $total;
	}

	public function imageSrc(){

		$src = $this->data('images') ? $this->data('images')->shift()->path : '';

		return $src;

	}

	public function hasMods() {

		return !! $this->data('user_modifications')->count();

	}
}
