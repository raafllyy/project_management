<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Cek role manual
        if (!$user->hasRole('Admin')) {
            abort(403); // Forbidden jika bukan Admin
        }

        // Statistik dasar
        $totalUsers = User::count();
        $totalPM = User::whereHas('roles', fn($q) => $q->where('name','Project Manager'))->count();
        $totalMembers = User::whereHas('roles', fn($q) => $q->where('name','Member'))->count();
        $totalProjects = Project::count();
        $totalTasks = Task::count();
        
        // User activity (contoh: 5 user terbaru)
        $recentUsers = User::with('roles')->latest()->take(5)->get();
        
        // Project status - jika tidak ada kolom status, gunakan alternatif:
        $activeProjects = Project::count(); // atau logika lain yang sesuai
        $completedProjects = 0; // atau logika lain yang sesuai

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalPM', 
            'totalMembers', 
            'totalProjects', 
            'totalTasks',
            'recentUsers',
            'activeProjects',
            'completedProjects'
        ));
    }
}