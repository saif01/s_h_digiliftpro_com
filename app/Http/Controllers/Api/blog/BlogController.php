<?php

namespace App\Http\Controllers\Api\blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        return response()->json(BlogPost::query()->orderByDesc('published_at')->paginate(30));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:255',
            'author_id' => 'required|integer',
            'published_at' => 'nullable|date',
            'published' => 'nullable|boolean',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['created_by'] = $request->user()?->id;
        $post = BlogPost::create($data);

        return response()->json($post, 201);
    }

    public function show(BlogPost $blog_post)
    {
        return response()->json($blog_post);
    }

    public function update(Request $request, BlogPost $blog_post)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|string|max:255',
            'author_id' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'published' => 'nullable|boolean',
        ]);

        $data['updated_by'] = $request->user()?->id;
        $blog_post->update($data);
        return response()->json($blog_post);
    }

    public function destroy(BlogPost $blog_post)
    {
        $blog_post->delete();
        return response()->json(['success' => true]);
    }
}


