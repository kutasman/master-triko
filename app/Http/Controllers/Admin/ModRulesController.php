<?php

namespace App\Http\Controllers\Admin;

use App\Models\Modificator;
use App\Models\ModRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Modificator $modificator)
    {
        $this->validate($request, [
            'target_id' => 'numeric|required|min:0',
            'option_id' => 'numeric|required|min:0',
            'action' => 'string|required',
        ]);

        $rule = $modificator->createRule($request->all());

        return response($rule);
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
     * @param  int  $modificator
     * @param  int  $modRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modificator $modificator, ModRule $modRule)
    {
        $modificator->rules()->delete($modRule);
        if ( !$modificator->rules->count()){

           $modificator->update(['toggle' => false]);
        }
    }
}
