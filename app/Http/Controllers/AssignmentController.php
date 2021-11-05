<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AssignmentRequest;

class AssignmentController extends Controller
{
    public function index() {
        return Assignment::with(['groups'])->get();
    }

    public function show($id) {
        return Assignment::with(['groups.mentors', 'groups.interns'])->findOrFail($id);
    }

    public function create(AssignmentRequest $request) {
        $assignment = Assignment::create($request->all());

        $response = [
            'assignment' => $assignment,
        ];

        return response($response, 201);
    }

    public function addToGroup($id, Request $request) {
        $a = Assignment::with('groups')->find($id);
        
        if(!$a) {
            return response()->json(['Messages' => 'Assignment does not exist!'], 404);
        }

        foreach($a->groups as $g) {
            if ($g->id == $request->input('group_id')) {
                return response()->json(['Messages' => 'Assignment is already added in this group.']);
            }
        }
                
        DB::table('assignment_group')->insert([
            'assignment_id' => $a->id,
            'group_id' => $request->input('group_id')
        ]);

        $a = $a->refresh();
        foreach($a->groups as $g) {
            if ($g->id == $request->input('group_id')) {
                $name = $g->name;
            }
        }
        
        $response = [
            'assignment' => $a,
            'messages' => $a->name." added in group ".$name
        ];
        
        return response()->json([$response], 200);   
    }

    public function removeFromGroup($id, Request $request) {
        
        DB::table('assignment_group')
            ->where('assignment_id',$id)
            ->where('group_id',$request->input('group_id'))
            ->delete();

    }

}
