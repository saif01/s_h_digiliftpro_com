<?php

namespace App\Http\Controllers\Api\users;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::query()->with('roles')->orderByDesc('created_at')->paginate(50));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'role_ids' => 'nullable|array',
            'role_ids.*' => 'integer',
        ]);

        // Extract role_ids before creating user (it's not a column in users table)
        $roleIds = $data['role_ids'] ?? null;
        unset($data['role_ids']);

        // Remove password_confirmation (it's only for validation)
        unset($data['password_confirmation']);

        // Hash password
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        // Sync roles if role_ids was provided
        if ($roleIds !== null) {
            $user->roles()->sync($roleIds);
        }

        return response()->json($user->load('roles'), 201);
    }

    public function show(User $user)
    {
        return response()->json($user->load('roles.permissions'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'role_ids' => 'nullable|array',
            'role_ids.*' => 'integer',
        ];

        // Only require password confirmation if password is provided
        if ($request->has('password') && !empty($request->password)) {
            $rules['password'] = 'required|string|min:6|confirmed';
        } else {
            $rules['password'] = 'nullable|string|min:6';
        }

        $data = $request->validate($rules);

        // Extract role_ids before updating user (it's not a column in users table)
        $roleIds = $data['role_ids'] ?? null;
        unset($data['role_ids']);

        // Remove password_confirmation (it's only for validation)
        unset($data['password_confirmation']);

        // Hash password if provided, otherwise remove it
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        // Sync roles if role_ids was provided
        if ($roleIds !== null) {
            $user->roles()->sync($roleIds);
        }

        return response()->json($user->load('roles'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }

    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return response()->json(['success' => true, 'is_active' => $user->is_active]);
    }

    public function roles()
    {
        return response()->json(Role::query()->orderBy('order')->get());
    }
}


