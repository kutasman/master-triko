<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$factories = Factory::all();
        return view('home', compact('factories'));
    }
}
