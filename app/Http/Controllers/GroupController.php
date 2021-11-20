<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\Group\GroupResource;
use App\Http\Resources\Group\ListGroupsResource;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Assignment;
use App\Models\Group;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        return ListGroupsResource::collection(Group::with(['mentors.user', 'interns', 'assignments'])->get());
    }

    public function show($id)
    {
        return new GroupResource(Group::with('mentors.user', 'interns', 'assignments')->findOrFail($id));
    }

    public function store(GroupRequest $request)
    {
        $group = Group::create($request->all());

        return new ListGroupsResource($group);
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->all());

        return new ListGroupsResource($group);
    }

    protected function activateAssignment($group, $assignment, Request $request)
    {
        DB::table('assignment_group')
            ->where('group_id', $group)
            ->where('assignment_id', $assignment)
            ->where('active', 0)
            ->update([
                'active' => 1,
                'start_date' => date('Y-m-d H:i:s'),
                'finish_date' => $request->finish_date ? $request->finish_date : date('Y-m-d H:i:s', strtotime("+1 month")),
            ]);

        return $message = 'Assignment activated!';
    }

    protected function deactivateAssignment($group, $assignment)
    {

        DB::table('assignment_group')
            ->where('group_id', $group)
            ->where('assignment_id', $assignment)
            ->where('active', 1)
            ->update([
                'active' => 0,
            ]);

        return $message = 'Assignment deactivated!';
    }

    public function activeChanger($group, $assignment, Request $request)
    {
        $a = Assignment::findOrFail($assignment)->groups()->where('group_id', $group)->first();

        if (!$a) {
            return response()->error("Group not found", 404);
        }
        $status = $a->pivot->active;

        if ($status == 0) {
            $message = $this->activateAssignment($group, $assignment, $request);
        } else {
            $message = $this->deactivateAssignment($group, $assignment);
        }

        $refreshed_a_p = $a->pivot->refresh();

        $response = [
            'message' => $message,
            'assignment' => $refreshed_a_p->active ? [
                'start_date' => $refreshed_a_p->start_date,
                'finish_date' => $refreshed_a_p->finish_date,
            ] : 'date is unset.',
        ];

        return response()->json($response, 202);
    }

    public function createReviewForAssignment($group, $assignment, $intern, ReviewRequest $request)
    {
        $g = Group::with('assignments')->find($group);
        if (!$g) {
            return response()->error("Group with id = $group don't exists.", 404);
        }

        $a = $g->assignments()->firstWhere('id', $assignment);
        if (!$a) {
            return response()->error("Assignment with id = $assignment don't exists in group $g->name.", 404);
        }

        $i = $g->interns()->firstWhere('id', $intern);
        if (!$i) {
            return response()->error("Intern with id = $intern don't exists in group $g->name.", 404);
        }

        $review = $a->reviews()->where('assignment_id', $a->id)
            ->where('mentor_id', auth('sanctum')->user()->id)
            ->where('intern_id', $i->id)
            ->first();

        if ($review) {
            $review->update([
                'assignment_id' => $a->id,
                'mentor_id' => auth('sanctum')->user()->id,
                'intern_id' => $i->id,
                'mark' => $request->mark,
                'pros' => $request->pros,
                'cons' => $request->cons,
            ]);

            return new ReviewResource($review);

        } else {
            $review = Review::create([
                'assignment_id' => $a->id,
                'mentor_id' => auth('sanctum')->user()->id,
                'intern_id' => $i->id,
                'mark' => $request->mark,
                'pros' => $request->pros,
                'cons' => $request->cons,
            ]);

            return new ReviewResource($review);
        }
    }

    public function destroy($id)
    {
        Group::find($id)->delete();
    }
}
