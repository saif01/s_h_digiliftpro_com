<?php

namespace App\Http\Controllers\Api\products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->orderByDesc('created_at');
        return response()->json($query->paginate(30));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'price' => 'nullable|numeric',
            'price_range' => 'nullable|string|max:255',
            'show_price' => 'nullable|boolean',
            'specifications' => 'nullable|array',
            'downloads' => 'nullable|array',
            'published' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'stock' => 'nullable|integer',
            'order' => 'nullable|integer',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $product = Product::create($data);

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'price' => 'nullable|numeric',
            'price_range' => 'nullable|string|max:255',
            'show_price' => 'nullable|boolean',
            'specifications' => 'nullable|array',
            'downloads' => 'nullable|array',
            'published' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'stock' => 'nullable|integer',
            'order' => 'nullable|integer',
        ]);

        $product->update($data);
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['success' => true]);
    }

    public function importTemplate()
    {
        $csv = "title,slug,sku,short_description,price,price_range,published,featured\n";
        $csv .= "Example Product,example-product,SKU-001,Short description,,Contact for pricing,1,0\n";

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=\"products-import-template.csv\"',
        ]);
    }
}


