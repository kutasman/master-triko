<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{


	public function index(Request $request, Cart $cart)
	{
		$cart->load('items');

		return view('checkout.index', compact('cart'));

	}

}
