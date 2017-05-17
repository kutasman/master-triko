<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Modificator extends Model
{


	protected $fillable = ['name', 'type', 'toggle'];

	protected $casts = [
	    'toggle' => 'boolean'
    ];


    //Relations______________

	public function factories()
	{
		return $this->morphedByMany(Factory::class, 'modificable');
	}

	public function products()
	{
		return $this->morphedByMany(Product::class, 'modificable');
	}

	public function options()
	{
		return $this->hasMany(ModOption::class);
	}

}
