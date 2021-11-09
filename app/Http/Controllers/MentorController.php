<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use Illuminate\Http\Request;
use App\Http\Requests\MentorRequest;
use App\Http\Resources\MentorResource;
use App\Http\Resources\ShowMentorResource;
use App\Http\Resources\IndexMentorsResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MentorController extends Controller
{
    public function index() {
        return IndexMentorsResource::collection(Mentor::with('user', 'groups')->get()); 
    }
    public function show($id) {
        $m = Mentor::with('user.role', 'groups.interns')->findOrFail($id);
        return new ShowMentorResource($m);
    }

    public function store(MentorRequest $request) {

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
        
        $mentor->user = $user;
        
        return new MentorResource($mentor);
    }

    public function update(MentorRequest $request,  $id) {
        try{
            $mentor = Mentor::with('user')->findOrFail($id);
        }catch (ModelNotFoundException $e){
            return response()->error("Mentor with this id don't exists.", 404);
        }

        $mentor->update($request->all());
        $mentor->user->update($request->all());
        $mentor->groups()->sync($request->input('group_id'));

        return new MentorResource($mentor);
    }

    public function destroy($id) {
        
        $mentor = Mentor::find($id);
        if(!$mentor) {
            return response()->error("Mentor with this id don't exists.", 404);
        }

        $user_id = $mentor->user->id;
        User::find($user_id)->delete();
    }
}
