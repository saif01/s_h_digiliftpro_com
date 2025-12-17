<?php

namespace App\Http\Controllers\Api\products;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $query = Tag::query()->orderBy('name');
        if ($type) {
            $query->where('type', $type);
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $tag = Tag::create($data);

        return response()->json($tag, 201);
    }

    public function show(Tag $tag)
    {
        return response()->json($tag);
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $tag->update($data);
        return response()->json($tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['success' => true]);
    }
}


