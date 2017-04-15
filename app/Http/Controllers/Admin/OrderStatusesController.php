<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$orderStatuses = OrderStatus::all();

    	if($request->ajax()){
    		return response($orderStatuses);
	    }

        return view('admin.order_statuses.index', compact('orderStatuses'));
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
	        'description' => 'sometimes|string',
	        'slug' => 'string|required|unique:order_statuses,slug',
        ]);

        $status = OrderStatus::create($request->all());

        if ($request->ajax()){
        	return response($status);
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
        $this->validate($request, [
        	'name' => 'string|required',
	        'description' => 'sometimes|string',
	        'slug' => "string|required|unique:order_statuses,slug,$id",
        ]);

        OrderStatus::find($id)->update($request->all());
        if ($request->ajax()){
        	return response('', 200);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        OrderStatus::find($id)->delete();
        if ($request->ajax()){
        	return response('', 200);
        }

        return redirect()->back();
    }
}
