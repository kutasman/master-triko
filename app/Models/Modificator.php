<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modificator extends Model
{
    protected $fillable = [
        'name', 'description', 'type', 'product_id'
    ];

    //Relations______________________

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
