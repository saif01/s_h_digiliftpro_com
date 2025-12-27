<?php

namespace App\Http\Controllers\Public\pages;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Services\TelegramNotify;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $data = $request->validate([
            'type' => 'nullable|string',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $lead = Lead::create([
            'type' => $data['type'] ?? 'contact',
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'],
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'] ?? null,
            'status' => 'new',
            'data' => null,
        ]);

        // Send Telegram notification
        try {
            TelegramNotify::notifyNewLead($lead);
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send Telegram notification for lead: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Message received',
            'lead_id' => $lead->id,
        ]);
    }
}


