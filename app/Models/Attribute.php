<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

	protected $fillable = [
		'name', 'description', 'type'
	];

	//Relations_____________

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
