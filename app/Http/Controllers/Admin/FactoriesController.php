<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Factory;
use App\Models\Modificator;
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
    	$factories->load('categories', 'modificators');
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
        $categories = Category::all();
        return view('admin.factories.create', compact('factory', 'categories'));
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


        return response($factory);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Factory $factory)
    {
    	$factory->load('modificators');
        return view('admin.factories.show', compact('factory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Factory $factory)
    {
    	$categories = Category::all();
    	$factory->load('modificators');

    	return view('admin.factories.edit', compact('factory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factory $factory)
    {
	    $this->validate($request, [
		    'name' => 'string|required',
		    'slug' => 'string|required|unique:factories,slug,' . $factory->id,
		    'categories.*' => 'numeric',
		    'categories' => 'nullable'
	    ]);

	    $factory->fill($request->all());
	    $factory->save();
	    $factory->categories()->sync($request->categories);

	    return redirect()->route('factories.edit', $factory->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factory $factory)
    {
        $factory->delete();

    }

    public function createModificator(Request $request, Factory $factory)
    {
        $this->validate($request, [
           'name' => 'string|required',
           'type' => 'string|required',
        ]);
    	$modificator = $factory->modificators()->create($request->all());

    	return response($modificator);

    }

    public function detachModificator(Request $request, Factory $factory, $modificator_id)
    {
        $factory->modificators()->detach([$modificator_id]);
    }


    public function getFactoryModificators(Factory $factory){

        return response($factory->modificators);

    }
}
