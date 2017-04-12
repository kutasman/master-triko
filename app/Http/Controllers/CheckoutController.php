<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ShippingType;
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

		$shippings = ShippingType::all();


		return \Response::json([
			'cart' => $cart,
			'shippings' => $shippings,
		]);

	}

	public function validateContacts(Request $request)
	{


		$this->validate($request, [
			'first_name' => 'string|required',
			'email' => 'email|required',
			'phone' => 'string|required',
		]);
	}

	public function validateShipping(Request $request) {

		$this->validate($request, [
			'type' => 'string|required|exists:shipping_types,slug',
			'data' => 'sometimes',
		]);

		return response($request->all());
	}

}
