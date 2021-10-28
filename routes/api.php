<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\MentorController;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/roles', [RoleController::class, 'index']);
Route::put('/roles/{role}', [RoleController::class, 'editRole']);

Route::get('/mentors', [MentorController::class, 'index']);
Route::get('/mentors/{mentor}', [MentorController::class, 'show']);
Route::post('/mentors/create', [MentorController::class, 'store']);
Route::put('/mentors/{mentor}', [MentorController::class, 'update']);
Route::delete('/mentors/{mentor}', [MentorController::class, 'destroy']);

Route::get('/groups', [GroupController::class, 'index']);
Route::get('/groups/{group}', [GroupController::class, 'show']);
Route::post('/groups/create', [GroupController::class, 'store']);
Route::put('/groups/{group}', [GroupController::class, 'update']);
Route::delete('/groups/{group}', [GroupController::class, 'destroy']);

Route::get('/interns', [InternController::class, 'index']);
Route::get('/interns/{intern}', [InternController::class, 'show']);
Route::post('/interns/create', [InternController::class, 'store']);
Route::put('/interns/{intern}', [InternController::class, 'update']);
Route::delete('/interns/{intern}', [InternController::class, 'destroy']);

//protected routes
Route::group(['middleware' =>['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', function () {
        return 'Hello';
    });
});
