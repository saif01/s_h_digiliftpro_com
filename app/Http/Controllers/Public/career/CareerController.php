<?php

namespace App\Http\Controllers\Public\career;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        return response()->json(
            Career::query()
                ->where('published', true)
                ->orderBy('order')
                ->get()
        );
    }

    public function show(string $slug)
    {
        $career = Career::query()->where('slug', $slug)->where('published', true)->first();
        if (!$career) {
            return response()->json(['message' => 'Career not found'], 404);
        }
        return response()->json($career);
    }

    public function apply(Request $request)
    {
        $data = $request->validate([
            'career_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'cover_letter' => 'nullable|string',
            'resume' => 'nullable|file|max:10240', // 10MB
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('uploads/careers', 'public');
        }

        $application = JobApplication::create([
            'career_id' => $data['career_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'cover_letter' => $data['cover_letter'] ?? null,
            'resume_path' => $resumePath,
            'status' => 'new',
        ]);

        return response()->json(['success' => true, 'application_id' => $application->id]);
    }
}


