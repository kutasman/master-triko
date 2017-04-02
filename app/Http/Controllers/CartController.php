<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Modificator;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CartController extends Controller
{
    public function addProduct(Request $request, Product $product, Cart $cart)
    {
    	//$cart = Cart::firstOrCreate(['session_id' => $request->session()->getId()]);

    	$cart->createItem($product, $request->modificators);     	//TODO Create valifation for user modification;

	    $request->session()->flash('status', 'Item was added to cart');


	    return redirect()->back();
    }

    public function show(Request $request)
    {
    	$cart = Cart::firstOrNew(['session_id' => $request->session()->getId()]);

    	$view = $cart->count() ? 'cart.cart' : 'cart.empty';

    	return view($view, compact('cart'));

    }

    public function removeItem(Request $request, CartItem $item){

    	$item->delete();

    	$request->session()->flash('status', 'Item was removed');

		return redirect()->route('cart.show');
    }

}
