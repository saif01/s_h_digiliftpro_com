<?php

namespace App\Http\Controllers\Public\pages;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $homePage = Page::where('slug', 'home')->first();

        $services = Service::query()
            ->where('published', true)
            ->orderBy('order')
            ->limit(6)
            ->get();

        $products = Product::query()
            ->where('published', true)
            ->orderByDesc('featured')
            ->orderBy('order')
            ->limit(6)
            ->get();

        $posts = BlogPost::query()
            ->where('published', true)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        $homePageSettings = Setting::query()
            ->where('group', 'home_page')
            ->pluck('value', 'key')
            ->toArray();

        return response()->json([
            'homePage' => $homePage,
            'services' => $services,
            'products' => $products,
            'posts' => $posts,
            'homePageSettings' => $homePageSettings,
        ]);
    }
}


