<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['name', 'description', 'slug'];

	public function orders() {

		return $this->belongsToMany(Order::class, 'status_id', 'order_id');

	}
}
