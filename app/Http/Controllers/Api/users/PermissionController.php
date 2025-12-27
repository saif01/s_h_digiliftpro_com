<?php

namespace App\Http\Controllers\Api\users;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Permission::query()
            ->withCount('roles')
            ->orderBy('group')
            ->orderBy('name');
        
        // Handle search parameter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Handle group filter
        if ($request->has('group') && $request->group) {
            $query->where('group', $request->group);
        }
        
        // Handle grouped parameter - return grouped by group name
        if ($request->has('grouped') && $request->grouped) {
            $permissions = $query->get();
            $grouped = $permissions->groupBy('group')->toArray();
            return response()->json($grouped);
        }
        
        // Handle pagination
        $perPage = $request->get('per_page', 15);
        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'group' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);
        $data['created_by'] = $request->user()?->id;
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
        $data['updated_by'] = $request->user()?->id;
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
            ->selectRaw('`group`, COUNT(*) as permissions_count')
            ->groupBy('group')
            ->orderBy('group')
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->group,
                    'permissions_count' => (int) $item->permissions_count
                ];
            });

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


