<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingType extends Model
{
    protected $fillable = ['name', 'description', 'slug', 'meta'];

    public $timestamps = false;

    protected $casts = [
    	'meta' => 'array',
    ];

    public function getMetaAttribute(){
    	return collect(json_decode($this->attributes['meta']));
    }

    //Relations_______________

	public function shippings()
	{
		return $this->hasMany(Shipping::class,'type_id');
	}
}
