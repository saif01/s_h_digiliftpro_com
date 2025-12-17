<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Lead;
use App\Models\NewsletterSubscription;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'counts' => [
                'users' => User::count(),
                'leads' => Lead::count(),
                'unread_leads' => Lead::where('is_read', false)->count(),
                'services' => Service::count(),
                'products' => Product::count(),
                'blog_posts' => BlogPost::count(),
                'newsletter_subscriptions' => NewsletterSubscription::count(),
            ],
        ]);
    }
}


