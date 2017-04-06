<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{


	public function index(Request $request, Cart $cart)
	{

		return view('checkout.index', compact('cart'));

	}

	public function getCart(Cart $cart) {
		return $cart->load('items');
	}
}
