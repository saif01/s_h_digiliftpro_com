<?php

namespace App\Http\Controllers\Api\newsletters;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        return response()->json(NewsletterSubscription::query()->orderByDesc('created_at')->paginate(50));
    }

    public function show(NewsletterSubscription $newsletterSubscription)
    {
        return response()->json($newsletterSubscription);
    }

    public function update(Request $request, NewsletterSubscription $newsletterSubscription)
    {
        $data = $request->validate([
            'status' => 'nullable|string|max:50',
        ]);
        $newsletterSubscription->update($data);
        return response()->json($newsletterSubscription);
    }

    public function destroy(NewsletterSubscription $newsletterSubscription)
    {
        $newsletterSubscription->delete();
        return response()->json(['success' => true]);
    }

    public function exportCsv()
    {
        $rows = NewsletterSubscription::query()->orderByDesc('created_at')->get();
        $csv = "id,email,status,subscribed_at,created_at\n";
        foreach ($rows as $r) {
            $csv .= "\"{$r->id}\",\"{$r->email}\",\"{$r->status}\",\"{$r->subscribed_at}\",\"{$r->created_at}\"\n";
        }
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="newsletter_subscriptions.csv"',
        ]);
    }
}


