<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Login
//----------------------------------
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Logout
    //----------------------------------
    Route::post('logout', [AuthController::class, 'logout']);

    // Profile
    //----------------------------------
    Route::get('me', [AuthController::class, 'me']);

    // Project
    //----------------------------------
    Route::apiResource('/projects', ProjectController::class)->only([
        "index",
        "store",
        "show"
    ]);

    // Add task to project
    //----------------------------------
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store']);
});
