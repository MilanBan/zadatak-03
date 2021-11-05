<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Http\Requests\InternRequest;

class InternController extends Controller
{
    public function index() {
        return Intern::with('group.mentors.user')->get();
    }

    public function show($id) {
        return Intern::with('group.mentors.user','group.assignments')->findOrFail($id);
    }

    public function store(InternRequest $request) {
        $intern = Intern::create($request->all());

        $response = [
            'intern' => $intern,
        ];

        return response($response, 201);
    }

    public function update(InternRequest $request, Intern $intern) {
        $intern->update($request->all());
        $response = [
            'intern' => $intern
        ];

        return response($response, 200);
    }

    public function destroy($id) {
        Intern::find($id)->delete();
    }
}
