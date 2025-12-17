<?php

namespace App\Http\Controllers\Api\career;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        return response()->json(JobApplication::query()->orderByDesc('created_at')->paginate(50));
    }

    public function statistics()
    {
        return response()->json([
            'total' => JobApplication::count(),
            'by_status' => JobApplication::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status'),
        ]);
    }

    public function show(JobApplication $jobApplication)
    {
        return response()->json($jobApplication);
    }

    public function update(Request $request, JobApplication $jobApplication)
    {
        $data = $request->validate([
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);
        $jobApplication->update($data);
        return response()->json($jobApplication);
    }

    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();
        return response()->json(['success' => true]);
    }
}


