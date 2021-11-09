<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\ShowGroupResource;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\Helper\GroupWithMentorsResource;

class GroupController extends Controller
{
    public function index() {
        return GroupWithMentorsResource::collection(Group::with(['mentors.user', 'interns', 'assignments'])->get());
    }

    public function show($id) {
        return new ShowGroupResource(Group::with('mentors.user', 'interns', 'assignments')->findOrFail($id));
    }

    public function store(GroupRequest $request) {
        $group = Group::create($request->all());

        return new GroupResource($group);
    }

    public function update(GroupRequest $request, Group $group) {
        $group->update($request->all());

        return new GroupResource($group);
    }

    protected function activateAssignment($g_id, $a_id,Request $request) {
        
        DB::table('assignment_group')
        ->where('group_id',$g_id)
        ->where('assignment_id',$a_id)
        ->where('active', 0)
        ->update([
            'active' => 1,
            'start_date' => date('Y-m-d H:i:s'),
            'finish_date' => $request->finish_date ? $request->finish_date : date('Y-m-d H:i:s', strtotime("+1 month")),
        ]);

        return $message = 'Assignment activated!';
    }  

    protected function deactivateAssignment($g_id, $a_id) {

        DB::table('assignment_group')
        ->where('group_id',$g_id)
        ->where('assignment_id',$a_id)
        ->where('active', 1)
        ->update([
            'active' => 0
        ]);

        return $message = 'Assignment deactivated!';
    }
   
    public function activeChanger($g_id, $a_id,Request $request) {
        $a =  Assignment::find($a_id);
        $status = $a->groups[0]->pivot->active;
        
        if($status == 0) {
            $message = $this->activateAssignment($g_id, $a_id, $request);
        }else{
            $message = $this->deactivateAssignment($g_id, $a_id);
        }
        $a->refresh();
        $response = [
            'message' => $message,
            'assignment' => $a->groups[0]->pivot->active ? [
                'start_date' => $a->groups[0]->pivot->start_date,
                'finish_date' => $a->groups[0]->pivot->finish_date,
            ] : 'date is unset.'
        ];

        return response()->json($response, 202);
    }
        
    public function destroy($id) {
        Group::find($id)->delete();
    }
}
