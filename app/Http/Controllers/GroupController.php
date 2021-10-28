<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\GroupRequest;

class GroupController extends Controller
{
    public function index() {
        return Group::with(['mentors.user', 'interns'])->get();
    }

    public function show($id) {
        return Group::with('mentors.user', 'interns')->findOrFail($id);
    }

    public function store(GroupRequest $request) {
        $g = Group::create($request->all());

        $response = [
            'group' => $g,
        ];

        return response($response, 201);
    }

    public function update(GroupRequest $request, Group $group) {
        $group->update($request->all());
        $response = [
            'group' => $group
        ];

        return response($response, 200);
    }

    public function destroy($id) {
        Group::find($id)->delete();
    }
}
