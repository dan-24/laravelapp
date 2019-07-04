<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;


class Rolecontroller extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
        }

        return response(['permission' => $request->permissions ]);

    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required']);
        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions(collect($request->permissions)->pluck('id')->toArray());
        }

        return response(['permission' => $request->permissions]);
    }

    public function destroy($id)
    {
        return Role::destroy($id);
    }
}
