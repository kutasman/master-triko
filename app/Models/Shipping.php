<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = ['meta'];

    protected $casts = [
    	'meta' => 'array'
    ];

    //Mutators__________________-

	public function getMetaAttribute() {
		return collect(json_decode($this->attributes['meta']));
	}
}