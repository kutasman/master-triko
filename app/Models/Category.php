<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
    	'name', 'description'
    ];

    //Relations___________________

	public function products()
	{
		return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
	}
}
