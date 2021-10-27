<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreMentorRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MentorController extends Controller
{
    public function index() {
        return Mentor::with('user', 'groups')->get();
       
    }
    public function show($id) {
        return Mentor::with('user.role', 'groups')->findOrFail($id);
    }

    public function store(StoreMentorRequest $request) {

        $user = new User();
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 3;

        $user->save();

        $mentor = new Mentor();
        $mentor->user_id = $user->id;
        $mentor->city = $request->input('city');
        $mentor->skype = $request->input('skype');

        $mentor->save();

        $mentor->groups()->sync($request->input('group_id'));

        $response = [
            'user' => $user,
            'mentor' => $mentor
        ];

        return response($response, 201);
    }

    public function update(StoreMentorRequest $request,  $id) {
        try{
            $mentor = Mentor::with('user')->findOrFail($id);
        }catch (ModelNotFoundException $e){
            return response(['message' => "Mentor with this id don't exists."], 404);
        }

        $mentor->update($request->all());
        $mentor->user->update($request->all());
        $mentor->groups()->sync($request->input('group_id'));


        $response = [
            'mentor' => $mentor
        ];

        return response($response, 200);
    }

    public function destroy($id) {
        
        $mentor = Mentor::find($id);
        if(!$mentor) {
            $response = ['message' => "Mentor does not exist."];
            
            return response($response, 404);
        }
        $user_id = $mentor->user->id;
        User::find($user_id)->delete();
    }
}
