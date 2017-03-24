<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModSelectOption extends Model
{
	protected $fillable = ['name', 'value'];
    //Relations_____________
	public function modificator()
	{
		return $this->belongsTo(Modificator::class);
	}

	public function getNameAttribute($name)
	{
		return $name .=  ($this->attributes['value']) ? ' (+' . $this->attributes['value'] . ' грн.)' : '';
	}
}
