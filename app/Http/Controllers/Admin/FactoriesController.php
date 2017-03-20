<?php

namespace App\Http\Controllers\Admin;

use App\Models\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FactoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$factories = Factory::all();
        return view('admin.factories.index', compact('factories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factory = new Factory();
        return view('admin.factories.create', compact('factory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	'name' => 'string|required',
	        'slug' => 'string|required|unique:factories,slug'
        ]);

        $factory = new Factory();
        $factory->fill($request->all());
        $factory->slug = str_slug($request->slug);
        $factory->save();

        return redirect()->route('factories.index');

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
    public function edit(Factory $factory)
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
        //
    }
}
