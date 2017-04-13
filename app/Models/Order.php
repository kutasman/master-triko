<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'first_name', 'last_name', 'email', 'phone', 'comment', 'cart_id',
    ];

    //Relations___________

	public function shipping() {
		return $this->hasOne(Shipping::class);
	}

	public function payment() {
		return $this->hasOne(Payment::class);
	}

	public function markCartAsOrdered() {
		if ($this->exists){
			Cart::whereId($this->cart_id)->update(['ordered' => 1]);
		}
	}
}
