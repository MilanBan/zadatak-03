<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Assignment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GroupRequest;
use Illuminate\Database\Eloquent\Collection;

class GroupController extends Controller
{
    public function index() {
        return Group::with(['mentors.user', 'interns', 'assignments'])->get();
    }

    public function show($id) {
        return Group::with('mentors.user', 'interns', 'assignments')->findOrFail($id);
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

    protected function activateAssignment($g_id, $a_id) {
        
        DB::table('assignment_group')
        ->where('group_id',$g_id)
        ->where('assignment_id',$a_id)
        ->where('active', 0)
        ->update([
            'active' => 1,
            'start_date' => date('Y-m-d H:i:s'),
        ]);

        return $message = ['Assignment activated!'];
    }  

    protected function deactivateAssignment($g_id, $a_id) {

        DB::table('assignment_group')
        ->where('group_id',$g_id)
        ->where('assignment_id',$a_id)
        ->where('active', 1)
        ->update([
            'active' => 0
        ]);

        return $message = ['Assignment deactivated!'];
    }
   
    public function activeChanger($g_id, $a_id) {
        $a =  Assignment::find($a_id);
        $g = collect($a->groups);
        $status = $g[0]->pivot->active;
        
        if($status == 0) {
            $message = $this->activateAssignment($g_id, $a_id);
        }else{
            $message = $this->deactivateAssignment($g_id, $a_id);
        }
        
        $response = [
            'assignment' => $a->refresh(),
            'message' => $message
        ];

        return response()->json($response, 202);
    }
        
    public function destroy($id) {
        Group::find($id)->delete();
    }
}
