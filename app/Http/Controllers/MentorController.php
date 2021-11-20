<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Mentor;
use App\Http\Requests\UserRequest;
use App\Http\Requests\MentorRequest;
use App\Http\Resources\Mentor\MentorResource;
use App\Http\Resources\Mentor\MentorsResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MentorController extends Controller
{
    public function index()
    {
        return MentorsResource::collection(Mentor::with('user', 'groups', 'reviews')->get());
    }
    public function show($id)
    {
        $m = Mentor::with('user.role', 'groups.interns')->findOrFail($id);
        return new MentorResource($m);
    }

    public function store(MentorRequest $request_m, UserRequest $request_u)
    {
        $user = new User();
        $user->firstName = $request_u->input('firstName');
        $user->lastName = $request_u->input('lastName');
        $user->email = $request_u->input('email');
        $user->password = bcrypt($request_u->input('password'));
        $user->role_id = 3;

        $user->save();

        $mentor = new Mentor();
        $mentor->user_id = $user->id;
        $mentor->city = $request_m->input('city');
        $mentor->skype = $request_m->input('skype');

        $mentor->save();

        $mentor->groups()->sync($request_m->input('group_id'));

        $mentor->user = $user;

        return new MentorResource($mentor);
    }

    public function update(MentorRequest $request, $id)
    {
        try {
            $mentor = Mentor::with('user')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->error("Mentor with this id don't exists.", 404);
        }

        $mentor->update($request->all());
        $mentor->user->update($request->all());
        $request->input('group_id') ? $mentor->groups()->sync($request->input('group_id')) : '';

        return new MentorResource($mentor);
    }

    public function addToGroup($m_id, $g_id) {
        $mentor = Mentor::with('groups')->find($m_id);
        if (!$mentor) {
            return response()->error("Mentor with id=$m_id don't exists.", 404);
        }
        if (Group::where('id', '=', $g_id)->count() < 1) {
            return response()->error("Group with id=$g_id don't exists.", 404);
        }
        foreach ($mentor->groups as $g){
            if ($g->id == $g_id){
                return response()->error("Mentor is already member of this group", 406);
            }
        }
        $mentor->groups()->attach($g_id);
        
        return new MentorResource($mentor);
    }

    public function destroy($id)
    {

        $mentor = Mentor::find($id);
        if (!$mentor) {
            return response()->error("Mentor with this id don't exists.", 404);
        }

        $user_id = $mentor->user->id;
        User::find($user_id)->delete();
    }
}
