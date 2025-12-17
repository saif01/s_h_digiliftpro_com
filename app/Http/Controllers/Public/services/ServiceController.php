<?php

namespace App\Http\Controllers\Public\services;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query()->where('published', true)->orderBy('order');

        return response()->json($query->get());
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->where('published', true)->first();
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        return response()->json($service);
    }
}


