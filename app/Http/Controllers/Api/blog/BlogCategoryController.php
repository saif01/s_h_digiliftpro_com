<?php

namespace App\Http\Controllers\Api\blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        return response()->json(
            Category::query()
                ->where('type', 'post')
                ->orderBy('order')
                ->paginate(50)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'published' => 'nullable|boolean',
        ]);

        $data['type'] = 'post';
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['created_by'] = $request->user()?->id;

        $cat = Category::create($data);
        return response()->json($cat, 201);
    }

    public function show(Category $blog_category)
    {
        return response()->json($blog_category);
    }

    public function update(Request $request, Category $blog_category)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'published' => 'nullable|boolean',
        ]);

        $data['updated_by'] = $request->user()?->id;
        $blog_category->update($data);
        return response()->json($blog_category);
    }

    public function destroy(Category $blog_category)
    {
        $blog_category->delete();
        return response()->json(['success' => true]);
    }
}


