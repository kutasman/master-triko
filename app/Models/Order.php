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

	public function cart(){
		return $this->belongsTo(Cart::class);
	}

	public function statuses()
	{
		return $this->belongsToMany(OrderStatus::class, 'order_status', 'order_id', 'status_id');
	}

	//Methods


	public function markCartAsOrdered() {

		Cart::findOrFail($this->cart_id)->markAsOrdered()->save();
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
			$this->statuses()->sync([$status->id]);
		} else {
			throw new ModelNotFoundException('No such order status');
		}

		return $this;
	}

	public function setStatusBySlug( $slug ) {

		if ($status = OrderStatus::whereSlug($slug)->first()){
			$this->statuses()->sync([$status->id]);
		} else {
			throw new ModelNotFoundException('No such order status');
		}

		return $this;
	}

	public function getStatusSlug(){

		return $this->statuses()->first()->slug;

	}
}
