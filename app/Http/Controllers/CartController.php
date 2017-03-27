<?php

namespace App\Http\Controllers;
use App\Models\Modificator;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CartController extends Controller
{
    public function addProduct(Request $request, $product_id)
    {

    	$request->session()->push('cart', array_merge(['product_id' => $product_id], $request->only('modificators')));
	    $request->session()->flash('status', 'Item was added to cart');

	    return redirect()->back();
    }

    public function show(Request $request)
    {
    	//$request->session()->forget('cart');

    	if ($request->session()->has('cart')){
    		$cart = $this->getCart();
		    $products = new Collection();

		    //Iterate throw cart items
		    $cart->map(function($item, $key) use (&$products){
				$product = Product::whereId($item['product_id'])->with(['images' => function($query){
					$query->limit(1);
				}])->first();

			    $modificators = new Collection();

			    //Iterate throw item modificators
				if (!empty($item['modificators'])){

					foreach ($item['modificators'] as $modType => $modData){

						$modData = collect($modData);

						$modData->each(function($values, $modId) use (&$modificators, $modType){
							$modificator = Modificator::find($modId);

							if ('text' != $modType){
								$modificator->load(['options' => function($query) use ($values){
									$query->whereIn('id', collect($values));
								}]);
							} else {
								$modificator->value = $values;
							}

							$modificators->push($modificator);
						});
					}
				}

				$product->cart_modificators = $modificators;
				$products->push($product);
		    });

	    } else {
    		$products = new Collection();
    		$cart = new Collection();
	    }

		$total = $products->map(function ($product){
			$total = $product->price + $product->cart_modificators->pluck('options')->collapse()->sum('rise');

			return $total;
		})->sum();
	    return view('cart', compact('products','cart', 'total'));
    }

    public function removeItem(Request $request,$index){
		$cart = $this->getCart();

		$cart->splice($index,1);

		//$request->session()->forget('cart');
		$request->session()->put('cart', $cart);

		return redirect()->route('cart.show');
    }

    protected function getCart()
    {
    	return collect(\Session::get('cart'));

    }
}
