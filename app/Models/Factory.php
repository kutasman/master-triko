<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{

	protected $fillable = ['name'];

    //Relations______________

	public function products()
	{
		return $this->hasMany(Product::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'category_factory');
	}

	public function modificators()
	{
		return $this->morphToMany(Modificator::class, 'modificable');
	}
}
