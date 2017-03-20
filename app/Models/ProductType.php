<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //


	protected $fillable = ['name', 'slug'];

	//Relations__________________

	public function products()
	{
		return $this->hasMany(Product::class, 'type_slug', 'slug');
	}


}
