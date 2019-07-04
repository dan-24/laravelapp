<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if($request->has('role')) {
            $user->assignRole($request->role['name']);
        }

        return response(['message'=>'User Created', 'user'=>$user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate(['name' => 'required']);

        $user->update([
            'name' => $request->name, 
            'email' => $request->email 
        ]);

        if ($request->has('role')) {
            $user->syncRoles($request->role['name']);
        }

        return response(['message'=>'User Updated', 'user'=>$user]);

    }

    public function destroy($id)
    {
        return User::destroy($id);
    }
}
