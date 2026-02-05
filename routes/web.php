<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Models\Project;

// ===== Root =====
Route::get('/', function () {
    return redirect()->route('login');
});

// ===== Auth (Laravel Breeze) =====
require __DIR__.'/auth.php';

// ===== Protected Routes (Login Only) =====
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Projects: Member & PM bisa index & show. 
    // Sisanya (create, store, edit, update, destroy) dikunci di Controller atau Middleware.
    Route::resource('projects', ProjectController::class);
    
    // Fitur Selesaikan Project (Hanya PM)
    Route::patch('/projects/{project}/complete', [ProjectController::class, 'complete'])
        ->name('projects.complete')
        ->middleware('role:Project Manager');

    // Tasks Management
    Route::resource('tasks', TaskController::class);
});

// ===== Admin Routes =====
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
});

// ===== Member Specific Routes =====
Route::middleware(['auth', 'role:Member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks', [MemberController::class, 'myTasks'])->name('tasks');
    Route::put('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
});

// Helper API untuk Dynamic Member Dropdown
Route::get('/projects/{project}/members', function(Project $project){
    return $project->members;
})->name('projects.members')->middleware('auth');