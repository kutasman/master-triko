<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeType;
use App\Models\Category;
use App\Models\Factory;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('images')->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$product = new Product();
    	$factories = Factory::all();

	    return view('admin.products.create', compact('product', 'factories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $this->validate($request,[
        	'title' => 'string|required',
		    'price' => 'required|numeric|min:0',
        ]);


	    $product = Product::create($request->all());
	    return redirect()->route('products.edit', $product->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
    	$product->with(['images']);
    	$factories = Factory::all();
	    return view('admin.products.edit', compact('product', 'factories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
	    $this->validate($request,[
		    'title' => 'string|required',
		    'price' => 'required|numeric|min:0',
	    ]);

	    $product->update($request->all());


	    return redirect()->route('products.edit', $product->id);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

	/**
	 * @param Request $request
	 * @param Product $product
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addImage(Request $request, Product $product)
    {
    	$this->validate($request, [
    		'image' => 'image|required'
	    ]);

    	$image_path = $request->file('image')->store('products',['disk' => 'public']);

    	$product->images()->create([
    		'path' => $image_path
	    ]);
    	return redirect()->route('products.edit', $product->id);
    }

	/**
	 * @param Product $product
	 * @param Image $image
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function removeImage(Product $product ,Image $image){

    	Storage::disk('public')->delete($image->path);
		$image->delete();

		return redirect()->route('products.edit', $product->id);
    }
}
