<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        // Vue SPA entry point
        return view('welcome');
    }
}


