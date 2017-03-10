<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CraftController extends Controller
{

    public function general()
    {
		return view('craft.general');
    }

    public function models(Request $request)
    {
    	$items = ['model1', 'model2'];
		return view('craft.models', compact('request', 'items'));
    }



    public function confirmation(Request $request){
    	return view('craft.confirmation');
    }

    public function finish(Request $request)
    {
    	return view('craft.finish');
    }

}
