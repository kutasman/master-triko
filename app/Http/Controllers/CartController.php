<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProduct(Request $request, $product_id)
    {

		dd($request->all());
	    $request->session()->push('cart', array_merge(['product_id' => $product_id], $request->only('modificators')) );
	    $request->session()->flash('status', 'Item was added to cart');

	    return redirect()->back();
    }

    public function show(Request $request)
    {

	    $cart = collect($request->session()->get('cart'))->values();


	    $products = Product::whereIn('id', $cart->pluck('product_id'))->with('modificators', 'images')->get();

    	return view('cart', compact('products'));
    }
}
