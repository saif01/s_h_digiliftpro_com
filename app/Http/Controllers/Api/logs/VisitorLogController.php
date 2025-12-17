<?php

namespace App\Http\Controllers\Api\logs;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;
use Illuminate\Http\Request;

class VisitorLogController extends Controller
{
    public function index()
    {
        return response()->json(VisitorLog::query()->orderByDesc('created_at')->paginate(50));
    }

    public function show(VisitorLog $visitor_log)
    {
        return response()->json($visitor_log);
    }

    public function destroy(VisitorLog $visitor_log)
    {
        $visitor_log->delete();
        return response()->json(['success' => true]);
    }

    public function statistics()
    {
        return response()->json([
            'total' => VisitorLog::count(),
            'bots' => VisitorLog::where('is_bot', true)->count(),
            'today' => VisitorLog::whereDate('created_at', today())->count(),
        ]);
    }

    public function destroyMultiple(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
        ]);

        VisitorLog::whereIn('id', $data['ids'])->delete();
        return response()->json(['success' => true]);
    }
}


