<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\ProductType;
use Illuminate\Http\Request;

class CraftController extends Controller
{

	public function factory(Request $request, $slug)
	{
		$productType = ProductType::whereSlug($slug)->first();
		$productType->load('products');

		if ($request->isMethod('post')){
			$metaModel = 'App\Models\Meta' . ucfirst($productType->slug);
			$product =  $metaModel::findOrFail($request->only(['gender', 'sport']))->first()->product;
			return view('craft.factory', compact('product', 'productType'));
			//return $productType->products->first()->meta()->where(['gender' => 'male'])->get();
		} elseif ($request->isMethod('get')){
			$product = $productType->products->first();
			return view('craft.factory', compact('productType', 'product'));

		}

	}

}
