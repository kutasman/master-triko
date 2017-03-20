<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\ProductType;
use Illuminate\Http\Request;

class CraftController extends Controller
{

	public function factory(Request $request, Factory $factory)
	{
		return view('factory.index', compact('factory'));
	}

}
