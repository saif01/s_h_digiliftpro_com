<?php

namespace App\Http\Controllers\Public\blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 12);
        $search = (string) $request->query('search', '');
        $categorySlug = (string) $request->query('category', '');
        $sortBy = (string) $request->query('sort_by', 'published_at');
        $sortDirection = (string) $request->query('sort_direction', 'desc');

        $query = BlogPost::query()
            ->where('published', true)
            ->whereNotNull('published_at');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($categorySlug !== '') {
            $query->whereHas('categories', fn ($q) => $q->where('slug', $categorySlug));
        }

        $allowedSort = ['published_at', 'views', 'title'];
        if (!in_array($sortBy, $allowedSort, true)) {
            $sortBy = 'published_at';
        }
        $sortDirection = strtolower($sortDirection) === 'asc' ? 'asc' : 'desc';

        $query->orderBy($sortBy, $sortDirection);

        return response()->json($query->paginate($perPage));
    }

    public function categories()
    {
        return response()->json(
            Category::query()
                ->where('type', 'post')
                ->where('published', true)
                ->orderBy('order')
                ->get()
        );
    }

    public function show(string $slug)
    {
        $post = BlogPost::query()
            ->where('slug', $slug)
            ->where('published', true)
            ->first();

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->increment('views');
        return response()->json($post);
    }
}


