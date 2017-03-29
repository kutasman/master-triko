<?php

namespace App\Models;


use Illuminate\Support\Collection;

class Cart
{

	protected $items = [];


	public function add(CartItem $item)
	{
		$this->items[] = $item;
	}

	public function items()
	{
		return $this->items;
	}


	public function count()
	{
		return count($this->items);
	}

}
