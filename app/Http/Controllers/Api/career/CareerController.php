<?php

namespace App\Http\Controllers\Api\career;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index()
    {
        return response()->json(Career::query()->orderBy('order')->paginate(50));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'deadline' => 'nullable|date',
            'published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['created_by'] = $request->user()?->id;
        $career = Career::create($data);
        return response()->json($career, 201);
    }

    public function show(Career $career)
    {
        return response()->json($career);
    }

    public function update(Request $request, Career $career)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'deadline' => 'nullable|date',
            'published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $data['updated_by'] = $request->user()?->id;
        $career->update($data);
        return response()->json($career);
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return response()->json(['success' => true]);
    }
}


