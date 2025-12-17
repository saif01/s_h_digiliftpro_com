<?php

namespace App\Http\Controllers\Api\announcements;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function index()
    {
        return response()->json(Announcement::query()->orderByDesc('priority')->paginate(50));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'short_description' => 'nullable|string',
            'type' => 'nullable|string',
            'display_type' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'video' => 'nullable|string|max:255',
            'external_link' => 'nullable|string|max:255',
            'open_in_new_tab' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_active' => 'nullable|boolean',
            'priority' => 'nullable|integer',
            'language' => 'nullable|string|max:10',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|string|max:255',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['author_id'] = $request->user()?->id;

        $a = Announcement::create($data);
        return response()->json($a, 201);
    }

    public function show(Announcement $announcement)
    {
        return response()->json($announcement);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'short_description' => 'nullable|string',
            'type' => 'nullable|string',
            'display_type' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'video' => 'nullable|string|max:255',
            'external_link' => 'nullable|string|max:255',
            'open_in_new_tab' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_active' => 'nullable|boolean',
            'priority' => 'nullable|integer',
            'language' => 'nullable|string|max:10',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|string|max:255',
        ]);

        $announcement->update($data);
        return response()->json($announcement);
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return response()->json(['success' => true]);
    }

    public function toggleStatus(int $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->is_active = !$announcement->is_active;
        $announcement->save();

        return response()->json(['success' => true, 'is_active' => $announcement->is_active]);
    }
}


