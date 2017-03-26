<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModOption extends Model
{
	protected $fillable = ['name', 'rise'];

    //Relations__________________
	public function modificator(){
		return $this->belongsTo(Modificator::class);
	}

	//Mutators
	public function getNameAttribute($name)
	{
		return $name .=  ($this->attributes['rise']) ? ' (+' . $this->attributes['rise'] . ' грн.)' : '';
	}

}
