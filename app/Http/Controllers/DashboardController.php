<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ================= ADMIN =================
        if ($user->hasRole('Admin')) {

            return view('admin.dashboard', [
                'totalUsers' => User::count(),
                'totalPMs' => User::role('Project Manager')->count(),
                'totalMembers' => User::role('Member')->count(),
                'totalProjects' => Project::count(),
                'totalTasks' => Task::count(),
            ]);
        }

        // ================= PROJECT MANAGER =================
        elseif ($user->hasRole('Project Manager')) {

            $projects = Project::where('created_by', $user->id)->with('members')->get();

            $totalProjects = $projects->count();

            $totalTasks = Task::whereHas('project', function($q) use ($user) {
                $q->where('created_by', $user->id);
            })->count();

            // contoh progress (optional)
            $doneTasks = Task::whereHas('project', function($q) use ($user) {
                $q->where('created_by', $user->id);
            })->where('status','Done')->count();

            $progress = $totalTasks > 0 
                ? round(($doneTasks / $totalTasks) * 100) 
                : 0;

            return view('dashboard.pm', compact(
                'projects',
                'totalProjects',
                'totalTasks',
                'progress'
            ));
        }

        // ================= MEMBER =================
        else {

            return redirect()->route('member.dashboard');
        }
    }
}
