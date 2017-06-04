<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModOption extends Model
{
	protected $fillable = ['name', 'rise', 'default'];

	protected $casts = [
	    'default' => 'boolean',
    ];

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
