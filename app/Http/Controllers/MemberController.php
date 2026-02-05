<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;

class MemberController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        return view('member.dashboard', [
            'projects' => $user->projects()->count(),
            'tasks' => $user->tasks()->count(),
            'doneTasks' => $user->tasks()->where('status','Done')->count(),
        ]);
    }

    public function showTask(Task $task)
{
    // pastikan member hanya lihat task dia sendiri
    if ($task->user_id != Auth::id()) {
        abort(403);
    }

    $task->load('project');

    return view('member.task-detail', compact('task'));
}
    public function myTasks()
    {
        $tasks = Task::where('user_id', Auth::id())
                     ->with('project')
                     ->get();

        return view('member.tasks', compact('tasks'));
    }
}