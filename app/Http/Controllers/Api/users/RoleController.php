<?php

namespace App\Http\Controllers\Api\users;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(Role::query()->orderBy('order')->paginate(50));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_system' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $role = Role::create($data);
        return response()->json($role, 201);
    }

    public function show(Role $role)
    {
        return response()->json($role->load('permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_system' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);
        $role->update($data);
        return response()->json($role);
    }

    public function destroy(Role $role)
    {
        if ($role->is_system) {
            return response()->json(['message' => 'Cannot delete system role'], 422);
        }
        $role->delete();
        return response()->json(['success' => true]);
    }

    public function permissions()
    {
        return response()->json(Permission::query()->orderBy('group')->orderBy('name')->get());
    }

    public function syncPermissions(Request $request, int $id)
    {
        $role = Role::findOrFail($id);
        $data = $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'integer',
        ]);
        $role->permissions()->sync($data['permissions']);
        return response()->json(['success' => true]);
    }
}


