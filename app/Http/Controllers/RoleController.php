<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleController extends Controller
{
    public function index() {
        return Role::with('users')->get();
    }

    public function editRole(Request $request, $id) {
        try{
            $user = User::findOrFail($id);      
        }catch (ModelNotFoundException $e) {
            return response(['message' => "user doesn't exist"], 404);
        }

        $request->validate([
            'role_id' => 'integer|min:1|max:3'
        ]);

        $user->role_id = $request->role_id;

        $user->update();
        return response($user, 202);
    }

}
