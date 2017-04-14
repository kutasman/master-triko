<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Order extends Model
{
    protected $fillable = [
    	'first_name', 'last_name', 'email', 'phone', 'comment', 'cart_id', 'status_id'
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

	public function status()
	{
		return $this->hasOne(OrderStatus::class, 'id');
	}

	public function setStatus( $status ){

		if (is_int($status)){

			$this->setStatusById($status);

		} elseif (is_string($status)) {

			$this->setStatusBySlug($status);

		}

		return $this;
	}

	public function setStatusById($id){

		if ($status = OrderStatus::find($id)){
			$this->status_id = $status->id;
		} else {
			throw new ModelNotFoundException('No such order status');
		}

		return $this;
	}

	public function setStatusBySlug( $slug ) {

		if ($status = OrderStatus::whereSlug($slug)->first()){
			$this->status_id = $status->id;
		} else {
			throw new ModelNotFoundException('No such order status');
		}

		return $this;
	}

	public function getStatusSlug(){

		return $this->status->slug;

	}
}
