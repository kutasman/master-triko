<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

	function __construct() {
		$this->middleware(['auth']);
	}

	function index()
    {
    	return view('admin.index');
    }
}
