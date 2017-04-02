<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Factory;
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
    	$categories = Category::with('factories.products')->get();

        return view('home', compact('categories'));
    }
}
