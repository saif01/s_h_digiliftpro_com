<?php

namespace App\Http\Controllers\Api\settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Public settings endpoint: returns key => value.
     * Supports optional ?group=...
     */
    public function publicIndex(Request $request)
    {
        $group = $request->query('group');

        $query = Setting::query();
        if ($group) {
            $query->where('group', $group);
        }

        return response()->json($query->pluck('value', 'key')->toArray());
    }

    /**
     * Admin index: returns grouped settings in the shape expected by AdminSettings.vue
     */
    public function index()
    {
        $settings = Setting::all();
        $grouped = [];

        foreach ($settings as $s) {
            $group = $s->group ?: 'general';
            $grouped[$group][$s->key] = [
                'value' => $s->value ?? '',
                'type' => $s->type ?? 'text',
                'group' => $group,
            ];
        }

        return response()->json($grouped);
    }

    /**
     * Admin update (bulk): expects { settings: { key: {value,type,group}, ... } }
     */
    public function update(Request $request)
    {
        $payload = $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($payload['settings'] as $key => $value) {
            $group = $value['group'] ?? 'general';
            $type = $value['type'] ?? 'text';
            $val = $value['value'] ?? '';

            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'key' => $key,
                    'value' => is_string($val) ? $val : json_encode($val),
                    'type' => $type,
                    'group' => $group,
                ]
            );
        }

        return response()->json(['success' => true]);
    }
}


