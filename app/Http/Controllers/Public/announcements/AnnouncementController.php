<?php

namespace App\Http\Controllers\Public\announcements;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $query = Announcement::query()
            ->where('is_active', true)
            ->orderByDesc('priority')
            ->orderByDesc('start_date');

        return response()->json($query->get());
    }

    public function show(string $slug)
    {
        $announcement = Announcement::where('slug', $slug)->first();
        if (!$announcement) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
        return response()->json($announcement);
    }
}


