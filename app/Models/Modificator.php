<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Modificator extends Model
{


	protected $fillable = ['name', 'type'];


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
		if ($this->exists)
		{
			return $this->hasMany($this->getOptionModelName(), 'modificator_id');
		} else {
			throw new ModelNotFoundException('can\'t find model for unknown mod type');
		}
	}

	public function getOptionModelName()
	{

		return 'App\Models\Mod' . ucfirst($this->type) . 'Option';
	}
}
