<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
    	'name', 'description', 'parent_id',
    ];

    //Relations___________________

	public function products()
	{
		return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
	}

	public function factories()
	{
		return $this->belongsToMany(Factory::class, 'category_factory');
	}

	public function categories()
	{
		return $this->hasMany(Category::class, 'parent_id');
	}

}
