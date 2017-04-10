<?php

namespace App\Http\Controllers\Admin;

use App\Models\Modificator;
use App\Models\ShippingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    if ($request->ajax()){
	    	$shippingTypes = ShippingType::all();
		    return response($shippingTypes);
	    }

        return view('admin.shipping_types.index');
    }

	/**
	 * Retrieve all registered shipping types
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all(Request $request) {


		return response(['name' => 'dasdasd']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request,
		   [   'name' => 'string',
		       'description' => 'string',
		       'slug' => 'string|unique:shipping_types,slug',
		       'meta' => 'required',
		       'meta.*' => 'string',
		   ]);

		$shippingType =  ShippingType::create($request->all());

		if ($request->ajax()){
			return response($shippingType);
		} else {
			return redirect()->back();
		}
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	ShippingType::destroy($id);

        return response(null);
    }
}
