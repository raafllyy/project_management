<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MemberController;
use App\Models\Project;
// ===== Root =====
Route::get('/', function () {
    return redirect()->route('login'); // redirect default ke login
});

// ===== Auth =====
require __DIR__.'/auth.php'; // ini sudah memanggil route login Breeze

// ===== Protected Routes =====

// PM 
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
});


// Admin routes
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');

    // CRUD users
    Route::resource('users', UserController::class);
});


Route::patch('/projects/{project}/complete',
    [ProjectController::class, 'complete']
)->name('projects.complete');

// DITAMBAHKAN di web.php
Route::middleware(['auth','role:Member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks', [MemberController::class, 'myTasks'])->name('tasks');
    Route::put('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    
});
Route::get('/projects/{project}/members', function(Project $project){
    return $project->members; // kembalikan json
})->name('projects.members');