<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Product;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function index(Request $request, Factory $factory)
    {

	    if ( $request->isMethod('get')) {

		    $product = $factory->products->first();


        } elseif ($request->isMethod('post')){

			$product = Product::find($request->model);

	    }

	    return view('factory.index', compact('factory', 'product'));

    }

    public function show(Factory $factory)
    {
        $factory->load('products.modificators.options', 'products.mod_rules');


        return view('factory.show', compact('factory'));
    }
}
