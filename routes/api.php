<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\TaskApiController;


Route::middleware('auth:sanctum')->group(function () {

    // Project API
    Route::get('/projects', [ProjectApiController::class, 'index']);
    Route::get('/projects/{project}', [ProjectApiController::class, 'show']);
    Route::post('/projects', [ProjectApiController::class, 'store']);
    Route::put('/projects/{project}', [ProjectApiController::class, 'update']);
    Route::delete('/projects/{project}', [ProjectApiController::class, 'destroy']);

    // Task API
    Route::get('/projects/{project}/tasks', [TaskApiController::class, 'index']);
    Route::post('/projects/{project}/tasks', [TaskApiController::class, 'store']);
    Route::put('/tasks/{task}', [TaskApiController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskApiController::class, 'destroy']);
});

