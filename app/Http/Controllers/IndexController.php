<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function login(){
    	$all = request()->all();
    	dump($all);
    	return view('login');
    }
}
