<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        NewsletterSubscription::updateOrCreate(
            ['email' => $data['email']],
            ['status' => 'active', 'unsubscribed_at' => null]
        );

        return response()->json(['success' => true, 'message' => 'Subscribed']);
    }
}


