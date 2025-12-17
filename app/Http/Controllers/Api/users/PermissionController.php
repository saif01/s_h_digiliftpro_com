<?php

namespace App\Http\Controllers\Api\users;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return response()->json(Permission::query()->orderBy('group')->orderBy('name')->paginate(100));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'group' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);
        $perm = Permission::create($data);
        return response()->json($perm, 201);
    }

    public function show(Permission $permission)
    {
        return response()->json($permission);
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'group' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);
        $permission->update($data);
        return response()->json($permission);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['success' => true]);
    }

    public function groups()
    {
        $groups = Permission::query()
            ->select('group')
            ->distinct()
            ->orderBy('group')
            ->pluck('group')
            ->values();

        return response()->json($groups);
    }

    public function renameGroup(Request $request)
    {
        $data = $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
        ]);

        Permission::where('group', $data['from'])->update(['group' => $data['to']]);
        return response()->json(['success' => true]);
    }

    public function deleteGroup(Request $request)
    {
        $data = $request->validate([
            'group' => 'required|string',
        ]);

        Permission::where('group', $data['group'])->delete();
        return response()->json(['success' => true]);
    }
}


