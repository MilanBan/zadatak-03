<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function indexR()
    {
        return response()->success(Role::with('users')->get());
    }
    public function indexU()
    {
        return UserResource::collection(User::all());

    }

    public function editRole(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->error("user doesn't exist", 404);
        }

        $request->validate([
            'role_id' => 'integer|min:1|max:3',
        ]);

        $user->role_id = $request->role_id;

        $user->update();

        return new UserResource($user);
    }

}
