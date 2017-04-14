<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['name', 'description', 'slug'];

    //Mutators___________

	public function setSlugAttribute( $value ) {

		$this->attributes['slug'] = snake_case($value);

	}
}
