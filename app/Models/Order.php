<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'first_name', 'last_name', 'email', 'phone', 'comment',
    ];

    //Relations___________

	public function shipping() {
		return $this->hasOne(Shipping::class);
	}
}
