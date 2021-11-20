<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

//public routes
Route::post('/register', [AuthController::class, 'register']); // email , password , password_confirmation
Route::post('/login', [AuthController::class, 'login']); // email , password

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //Assignments
    Route::get('/assignments', [AssignmentController::class, 'index']);
    Route::get('/assignments/{assignment}', [AssignmentController::class, 'show']);
    Route::post('/assignments/{assignment}/{group}/add', [AssignmentController::class, 'addToGroup']); // add existing assignment from assignments table to group (cloning)
    Route::post('/assignments/create', [AssignmentController::class, 'store']); // input:  name , description
    Route::put('/assignments/{assignment}', [AssignmentController::class, 'update']); // input:  name , description
    Route::delete('/assignments/{assignment}/{group}/remove', [AssignmentController::class, 'removeFromGroup']); // removing assignment from group

    //Mentors
    Route::get('/mentors', [MentorController::class, 'index']);
    Route::get('/mentors/{mentor}', [MentorController::class, 'show']);
    Route::post('/mentors/create', [MentorController::class, 'store'])->middleware('recruiter'); // input: firstName, lastName, email, password, password_confirmation, city, skype, (optional $group_id)
    Route::put('/mentors/{mentor}', [MentorController::class, 'update']); // input: firstName, lastName, email, password, password_confirmation, city, skype, (optional $group_id)
    Route::put('/mentors/{mentor}/{group}/add', [MentorController::class, 'addToGroup'])->middleware('recruiter'); // add mentor in group
    Route::delete('/mentors/{mentor}', [MentorController::class, 'destroy'])->middleware('recruiter');

    //Groups
    Route::get('/groups', [GroupController::class, 'index']);
    Route::get('/groups/{group}', [GroupController::class, 'show']);
    Route::post('/groups/create', [GroupController::class, 'store'])->middleware('recruiter'); // input: name
    Route::put('/groups/{group}', [GroupController::class, 'update']); // input: name
    Route::delete('/groups/{group}', [GroupController::class, 'destroy'])->middleware('recruiter');
    Route::put('/groups/{group}/{assignment}/active', [GroupController::class, 'activeChanger']); // change active status of assignment in group and set start and finish date
    Route::post('/groups/{group}/{assignment}/{intern}/create-review', [GroupController::class, 'createReviewForAssignment']); // input: mark, pros, cons

    //Interns
    Route::get('/interns', [InternController::class, 'index']);
    Route::get('/interns/{intern}', [InternController::class, 'show']);
    Route::post('/interns/create', [InternController::class, 'store']); // input: firstName, lastName, city, address, email, telephone, cv(file), github, group_id(existing group)
    Route::post('/interns/{intern}', [InternController::class, 'update']); // input: firstName, lastName, city, address, email, telephone, cv(file), github, group_id(existing group)
    Route::delete('/interns/{intern}', [InternController::class, 'destroy']);

    //Reviews
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy']);

    //guards - admin lvl
    Route::group(['middleware' => ['admin']], function () {
        //Roles
        Route::get('/roles', [RoleController::class, 'indexR']); // list of roles
        Route::get('/users', [RoleController::class, 'indexU']); // list of users
        Route::put('/roles/{role}', [RoleController::class, 'editRole']); // edit role

    });

});
