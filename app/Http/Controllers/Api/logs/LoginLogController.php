<?php

namespace App\Http\Controllers\Api\logs;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;

class LoginLogController extends Controller
{
    public function index()
    {
        return response()->json(LoginLog::query()->orderByDesc('created_at')->paginate(50));
    }

    public function show(LoginLog $login_log)
    {
        return response()->json($login_log);
    }

    public function destroy(LoginLog $login_log)
    {
        $login_log->delete();
        return response()->json(['success' => true]);
    }

    public function statistics()
    {
        return response()->json([
            'total' => LoginLog::count(),
            'success' => LoginLog::where('status', 'success')->count(),
            'failed' => LoginLog::where('status', 'failed')->count(),
        ]);
    }
}


