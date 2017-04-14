<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\ShippingType;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{


	public function index(Request $request, Cart $cart)
	{
		$cart->load('items', 'order');

		if ($cart->order()->count() || !$cart->count()){

			return redirect()->route('home');
		}

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
		$payments = PaymentType::all();


		return \Response::json([
			'cart' => $cart,
			'shippings' => $shippings,
			'payments' => $payments,
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

	public function validatePayment(Request $request) {
		$this->validate($request, [
			'type' => 'string|required|exists:payment_types,slug',
		]);

		if ($request->ajax()){
			return response('',200);
		}
	}

	public function confirmOrder( Request $request ) {

		$this->validate($request, [
			'cart_id' => 'required|numeric|exists:carts,id',
			'first_name' => 'string|required',
			'email' => 'email|required',
			'phone' => 'string|required',
			'payment' => 'required',
			'payment.type' => 'string|required|exists:payment_types,slug',
			'shipping'=> 'required',
			'shipping.type_id' => 'numeric|required|exists:shipping_types,id',
		]);



		$order = Order::create($request->all());

		$order->payment()->create($request->payment);

		$order->shipping()->create($request->shipping);

		$order->markCartAsOrdered();

		$order->setStatus('new')->save();

		$request->session()->forget('cart');

		return response($order->id);

	}

}
