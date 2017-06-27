<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\ShippingType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;
use App\Contracts\Shop\Cart as CartInterface;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
	public function index(Request $request, CartInterface $cart)
	{

	    if ( ! $cart->hasItems()){

	        return redirect()->route('home');

        }

		$shippingTypes = ShippingType::all();
		$paymentTypes = PaymentType::all();


		return view('checkout.index', compact('cart', 'shippingTypes', 'paymentTypes'));

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
             'shipping.id' => 'numeric|required|exists:shipping_types,id',
             //for nova poshta delivery service
             'data.city' => 'required_if:shipping.slug,nova_poshta',
             'data.warehouse' => 'required_if:shipping.slug,nova_poshta'
         ]);
    }

	public function validatePayment(Request $request) {
		$this->validate($request, [
			'payment_type' => 'string|required|exists:payment_types,slug',
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

	public function getNPCities(){
		$cities = Cache::get('np_cities');
		if (!$cities){
			return response('No Content', 204);
		}
		return response($cities);
	}

	public function updateNPCities(Request $request){

		Cache::put('np_cities', $request->np_cities, Carbon::now()->addDay());
		return response(Cache::get('np_cities'));

	}

}
