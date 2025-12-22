<?php

namespace App\Http\Controllers\Api\about;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return response()->json(About::first() ?? []);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hero' => 'nullable|array',
            'story' => 'nullable|array',
            'values_title' => 'nullable|string|max:255',
            'values_subtitle' => 'nullable|string',
            'values' => 'nullable|array',
            'team_overline' => 'nullable|string|max:255',
            'team_title' => 'nullable|string|max:255',
            'team' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|string|max:255',
        ]);

        $about = About::first();
        if ($about) {
            $data['updated_by'] = $request->user()?->id;
            $about->update($data);
        } else {
            $data['created_by'] = $request->user()?->id;
            $about = About::create($data);
        }

        return response()->json($about, 201);
    }

    public function update(Request $request)
    {
        $about = About::first();
        if (!$about) {
            return $this->store($request);
        }

        $data = $request->validate([
            'hero' => 'nullable|array',
            'story' => 'nullable|array',
            'values_title' => 'nullable|string|max:255',
            'values_subtitle' => 'nullable|string',
            'values' => 'nullable|array',
            'team_overline' => 'nullable|string|max:255',
            'team_title' => 'nullable|string|max:255',
            'team' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|string|max:255',
        ]);

        $data['updated_by'] = $request->user()?->id;
        $about->update($data);
        return response()->json($about);
    }
}


