<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModTextOption extends Model
{
    //Relations_______________
	public function modificator()
	{
		return $this->belongsTo(Modificator::class);
	}
}
