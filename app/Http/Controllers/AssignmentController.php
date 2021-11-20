<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Http\Resources\Assignment\AssignmentResource;
use App\Http\Resources\Assignment\AssignmentsResource;
use App\Models\Assignment;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function index()
    {
        return AssignmentsResource::collection(Assignment::with(['groups'])->get());
    }

    public function show($id)
    {
        return new AssignmentResource(Assignment::with(['groups.mentors', 'groups.interns'])->findOrFail($id));
    }

    public function store(AssignmentRequest $request)
    {
        $assignment = Assignment::create($request->all());

        return new AssignmentResource($assignment);
    }

    public function update($id, AssignmentRequest $request)
    {
        $assignment = Assignment::find($id);
        if (!$assignment) {
            return response()->json(['Messages' => 'Assignment does not exist!'], 404);
        }

        $assignment->update($request->all());

        return new AssignmentResource($assignment);
    }

    public function addToGroup($a_id, $g_id)
    {
        $a = Assignment::with('groups')->find($a_id);

        if (!$a) {
            return response()->json(['Messages' => 'Assignment does not exist!'], 404);
        }
        if (Group::where('id', '=', $g_id)->count() < 1) {
            return response()->error("Group with id=$g_id don't exists.", 404);
        }
        foreach ($a->groups as $g) {
            if ($g->id == $g_id) {
                return response()->error("Assignment is already assigned to this group", 406);
            }
        }

        $a->groups()->attach($g_id);

        $a = $a->refresh();
        foreach ($a->groups as $g) {
            if ($g->id == $g_id) {
                $name = $g->name;
            }
        }
        $response = [
            'messages' => $a->name . " added in group " . $name,
            'assignment' => new AssignmentResource($a),
        ];

        return response()->json($response, 200);
    }

    public function removeFromGroup($a_id, $g_id)
    {
        DB::table('assignment_group')
            ->where('assignment_id', $a_id)
            ->where('group_id', $g_id)
            ->delete();
    }

}
