<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'title', 'description','price', 'type_slug', 'code'
    ];

    //Relations

	public function attributes()
	{
		return $this->hasMany(Attribute::class);
	}

	public function images()
	{
		return $this->morphMany(Image::class, 'imageable');
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
	}

	public function meta()
	{
		if ( $this->exists){
			return $this->hasOne('App\Models\Meta' . ucfirst($this->type_slug));
		} else {
			throw new \Exception('no such product meta model');
		}
	}

	public function type()
	{
		return $this->belongsTo(ProductType::class, 'type_slug', 'slug');
	}

	public function modificators()
	{
		return $this->hasMany(Modificator::class);
	}
}
