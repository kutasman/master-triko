<?php

namespace App\Http\Controllers;
use App\Contracts\Shop\CartItemsRepository;
use App\Models\Cart;
use App\Contracts\Shop\Cart as CartInterface;
use App\Models\CartItem;
use App\Models\Modificator;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CartController extends Controller
{
    public function addProduct(Request $request, CartInterface $cart)
    {
        $cart->addItem($request->all());

        return $cart->countItems();

    }

    public function show(Request $request, CartInterface $cart)
    {
    	$view = $cart->hasItems() ? 'cart.cart' : 'cart.empty';

    	return view($view, compact('cart'));

    }

    public function removeItem(Request $request, CartItem $item){

    	$item->delete();

    	$request->session()->flash('status', 'Item was removed');

		return redirect()->route('cart.show');
    }

}
