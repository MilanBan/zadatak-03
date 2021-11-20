<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Http\Requests\InternRequest;
use App\Http\Requests\EditInternRequest;
use App\Http\Resources\Intern\InternResource;
use App\Http\Resources\Intern\ListInternsResource;
use App\Http\Resources\Intern\CreateInternResource;

class InternController extends Controller
{
    public function index()
    {
        return ListInternsResource::collection(Intern::with('group.mentors.user')->get());
    }

    public function show($id)
    {
        return new InternResource(Intern::with('group.mentors.user', 'group.assignments')->findOrFail($id));
    }

    public function store(InternRequest $request)
    {
        $intern = Intern::create($request->all());

        $fileName = time().'_'.$request->file('cv')->getClientOriginalName();
        $filePath = $request->file('cv')->storeAs('uploads', $fileName, 'public');
        $intern->cv = '/storage/' . $filePath;

        $intern->save();

        return new CreateInternResource($intern);
    }

    public function update($id, EditInternRequest $request)
    {
        $intern = Intern::findOrFail($id);
        $intern->update($request->all());
        if($request->file('cv')){
            $fileName = time().'_'.$request->file('cv')->getClientOriginalName();
            $filePath = $request->file('cv')->storeAs('uploads', $fileName, 'public');
            $intern->cv = '/storage/' . $filePath;
        }

        $intern->update();

        return new CreateInternResource($intern);
    }

    public function destroy($id)
    {
        Intern::find($id)->delete();
    }
}
