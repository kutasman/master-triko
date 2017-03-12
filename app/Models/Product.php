<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'title', 'description','price'
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
}
