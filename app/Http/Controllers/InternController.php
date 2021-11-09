<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Http\Requests\InternRequest;
use App\Http\Resources\InternsResource;
use App\Http\Resources\ShowInternsResource;
use App\Http\Resources\IndexInternsResource;

class InternController extends Controller
{
    public function index() {
        return IndexInternsResource::collection( Intern::with('group.mentors.user')->get() );
    }

    public function show($id) {
        return new ShowInternsResource(Intern::with('group.mentors.user','group.assignments')->findOrFail($id));
    }

    public function store(InternRequest $request) {
        $intern = Intern::create($request->all());

        return new InternsResource($intern);
    }

    public function update(InternRequest $request, Intern $intern) {
        $intern->update($request->all());

        return new InternsResource($intern);
    }

    public function destroy($id) {
        Intern::find($id)->delete();
    }
}
