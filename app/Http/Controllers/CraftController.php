<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Illuminate\Http\Request;

class CraftController extends Controller
{

	public function general(Factory $factory)
	{
		return $factory->name;

	}

}
