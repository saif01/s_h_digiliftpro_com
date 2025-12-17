<?php

namespace App\Http\Controllers\Public\about;

use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        return response()->json(About::first() ?? []);
    }
}


