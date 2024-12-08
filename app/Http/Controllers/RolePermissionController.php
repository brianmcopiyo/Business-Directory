<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $search = $request->search ?? "";

        $roles = Role::query()
            ->withCount(['users', 'permissions'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orderBy('name', 'asc')
            ->get();

        $permissions = Permission::all();

        return view('app.users.roles.roles', compact('roles', 'search','permissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        // Create the role
        $role = Role::create(['name' => $request->name]);
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }
        return redirect()->back()->with('success', 'Role created successfully.');
    }

    public function storePermission(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions']);
        Permission::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Permission created successfully.');
    }

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('role-permissions.edit-role', compact('role', 'permissions'));
    }

    public function updateRole(Request $request, $roleId)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $roleId,
            'permissions' => 'array', // Permissions is an optional array
            'permissions.*' => 'exists:permissions,name',
        ]);

        // Find the role by its ID
        $role = Role::findOrFail($roleId);

        // Update the role's name
        $role->update(['name' => $request->name]);

        // Sync permissions for the role
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles-permissions')->with('success', 'Role updated successfully.');
    }


    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);

        return view('role-permissions.edit-permission', compact('permission'));
    }

    public function updatePermission(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $request->name]);

        return redirect()->route('roles-permissions.index')->with('success', 'Permission updated successfully.');
    }
}
