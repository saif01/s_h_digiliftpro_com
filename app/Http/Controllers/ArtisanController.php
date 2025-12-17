<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    /**
     * Minimal endpoint to run a small allowlist of artisan commands.
     * Keep disabled in production unless you fully secure it.
     */
    public function run(Request $request)
    {
        if (!config('app.debug')) {
            return response()->json(['message' => 'Disabled'], 403);
        }

        $command = (string) $request->input('command', '');
        $allowed = [
            'optimize:clear',
            'config:clear',
            'route:clear',
            'view:clear',
            'cache:clear',
            'migrate:status',
        ];

        if (!in_array($command, $allowed, true)) {
            return response()->json([
                'message' => 'Command not allowed',
                'allowed' => $allowed,
            ], 422);
        }

        Artisan::call($command);

        return response()->json([
            'command' => $command,
            'output' => Artisan::output(),
        ]);
    }
}


