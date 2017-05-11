<?php

namespace App\Http\Controllers\Admin;

use App\Models\Modificator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModificatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$modificators = Modificator::with(['products', 'factories'])->get();

        return view('admin.modificators.index', compact('modificators'));
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
    	$this->validate($request, [
    		'name' => 'string|required',
		    'type' => 'string|required',/*
		    'modificable_id' => 'numeric|min:0',
		    'modificable_type' => 'string|required',*/
	    ]);

		/*$class_name = $request->modificable_type;

    	if (class_exists($class_name)){
    		$model = $class_name::findOrFail($request->modificable_id);
    		$model->modificators()->create($request->only('name', 'type'));
	    } else {
    		throw new \Exception('no such model');
	    }*/

		$modificator = Modificator::create($request->all());

	    return response($modificator);
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
    public function destroy(Modificator $modificator)
    {
		$modificator->delete();

    }

    public function createOptions(Request $request, Modificator $modificator)
    {
		$this->validate($request, $this->getOptionValidationRules($modificator));

		$modificator->options()->create($request->all());

		return redirect()->back();

    }

    public function detach(Request $request, $modificator_id)
    {
    	$this->validate($request,[
    		'modificable_id' => 'numeric|min:0,required',
		    'modificable_type' => 'string|required',
	    ]);
    	$class_name = $request->modificable_type;
    	if (class_exists($class_name)){
    		$modificable = $class_name::findOrFail($request->modificable_id);
    		$modificable->modificators()->detach($modificator_id);
	    } else {
    		throw new \Exception('no such model');
	    }

	    return redirect()->back();
    }

    public function options(Modificator $modificator){
        return $modificator->options;
    }

    protected function getOptionValidationRules(Modificator $modificator)
    {
    	$type = $modificator->type;
    	if ( in_array($type, ['text', 'select'])){
    		return [
			    'name' => 'string|required',
			    'value' => 'numeric|required',
		    ];
	    } else {
    		throw new \Exception('undefined modificator type');
	    }
    }
}
