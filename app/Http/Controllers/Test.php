<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class Test extends Controller
{
    public function index()
    {
        return response()->json( Permission::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Permission::create(['name' => $request->name]);
        return response()->json(['message' => 'Permission created']);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $permission->update(['name' => $request->name ]);

        return response(['message' => 'Update completed']);
        
    }

    public function destroy($id)
    {
        Permission::destroy($id);
    }
}
