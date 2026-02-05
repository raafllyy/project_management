<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Project Manager')) {
            $tasks = Task::with(['project','user'])->latest()->get();
        } else {
            $tasks = Task::with(['project','user'])
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create()
{
    $projects = Project::all();       // semua project
    return view('tasks.create', compact('projects'));
}





    public function store(Request $request)
{
    $project = Project::findOrFail($request->project_id);

    // cek apakah user_id memang member project
    if (!$project->members->contains('id', $request->user_id)) {
        abort(403, 'User bukan anggota project');
    }

    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'deadline' => $request->deadline,
        'status' => 'todo',
        'project_id' => $project->id,
        'user_id' => $request->user_id,
    ]);

    return redirect()->route('tasks.index');
}


    public function edit(Task $task)
    {
        $projects = Project::all();
        $users = User::role('Member')->get();

        return view('tasks.edit', compact('task','projects','users'));
    }

    public function update(Request $request, Task $task)
    {
        if (Auth::user()->hasRole('Member')) {
            $validated = $request->validate([
                'status' => 'required|in:Todo,In Progress,Done'
            ]);

            $task->update($validated);
        } else {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'deadline' => 'required|date',
                'project_id' => 'required|exists:projects,id',
                'user_id' => 'required|exists:users,id',
                'status' => 'required|in:Todo,In Progress,Done',
            ]);

            $task->update($validated);
        }

        // ⭐ AUTO UPDATE PROJECT STATUS
        $project = $task->project;

        if ($project->progress() == 100) {
            $project->update(['status' => 'Complete']);
        } else {
            $project->update(['status' => 'Active']);
        }

        return redirect()->route('tasks.index')
            ->with('success','Task berhasil diupdate!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success','Task berhasil dihapus!');
    }
    
    // ✅ TAMBAHKAN METHOD UNTUK MEMBER UPDATE STATUS
    public function updateStatus(Request $request, Task $task)
    {
        // Pastikan hanya member yang punya task ini
        if ($task->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:Todo,In Progress,Done'
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->route('member.tasks')
            ->with('success', 'Task status berhasil diupdate!');
    }
}