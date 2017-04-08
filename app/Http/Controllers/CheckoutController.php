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

	public function getCart(Request $request)
	{
		$cart = Cart::whereSession($request->cart_session)->first();
		$cart->load('items');

		$cart->total = $cart->total();

		$cart->items->each(function ($item){

			$item->total = $item->total();
		});


		return \Response::json([
			'cart' => $cart,
		]);

	}
}
