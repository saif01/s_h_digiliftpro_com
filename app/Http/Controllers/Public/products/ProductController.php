<?php

namespace App\Http\Controllers\Public\products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()
            ->with(['categories', 'tags'])
            ->where('published', true)
            ->orderByDesc('featured')
            ->orderBy('order');

        return response()->json($query->get());
    }

    public function show(string $slug)
    {
        $product = Product::query()
            ->with(['categories', 'tags'])
            ->where('slug', $slug)
            ->where('published', true)
            ->first();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
}


