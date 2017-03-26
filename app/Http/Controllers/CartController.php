<?php

namespace App\Http\Controllers;
use App\Models\Modificator;
use Log;
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
		    $cart = collect($request->session()->get('cart'));
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

						$modData->each(function($options, $modId) use (&$modificators, $modType){
							$modificator = Modificator::find($modId);

							if ('text' != $modType){
								Log::info($options);
								$modificator->load(['options' => function($query) use ($options){
									$query->whereIn('id', collect($options));
								}]);
							} else {
								$modificator->value = $options;
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


	    return view('cart', compact('products','cart'));
    }
}
