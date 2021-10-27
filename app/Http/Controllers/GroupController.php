<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index() {
        return Group::with('mentors.user')->get();
    }

    public function show($id) {
        return Group::with('mentors.user')->findOrFail($id);
    }


}
