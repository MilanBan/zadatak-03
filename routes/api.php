<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
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
Route::put('/mentors/update/{mentor}', [MentorController::class, 'update']);
Route::delete('/mentors/delete/{mentor}', [MentorController::class, 'destroy']);



//protected routes
Route::group(['middleware' =>['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', function () {
        return 'Hello';
    });
});
