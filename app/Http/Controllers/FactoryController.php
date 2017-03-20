<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function index(Factory $factory)
    {
    	return view('factory.index', compact('factory'));
    }
}
