<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    //Relations

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
