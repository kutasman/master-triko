<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$attributes = Attribute::all();
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attribute = new Attribute();

        return view('admin.attributes.create', compact('attribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->validate($request, [
        	'name' => 'string|required',
	        'description' => 'string',
	        'type_id' => 'numeric|min:1|required',
        ]);

        $attribute = $product->attributes()->create($request->all());


        return redirect()->route('products.edit', ['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
		$this->validate($request, [
			'name' => 'string|required',
			'description' => 'string',
			'type' => 'string|required',
		]);

		$attribute->fill($request->all());
		$attribute->save();

		return redirect()->route('attributes.edit', $attribute->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return view('admin.attributes.index');
    }
}
