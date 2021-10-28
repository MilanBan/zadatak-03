<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;

class InternController extends Controller
{
    public function index() {
        return Intern::with('group.mentors')->get();
    }

    public function show($id) {
        return Intern::with('group.mentors.user')->findOrFail($id);
    }

    public function store(Request $request) {
        $intern = Intern::create($request->all());

        $response = [
            'intern' => $intern,
        ];

        return response($response, 201);
    }

    public function update(Request $request, Intern $intern) {
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
