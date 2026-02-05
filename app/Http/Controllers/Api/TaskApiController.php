<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class TaskApiController extends Controller
{
    // GET /api/projects/{project}/tasks -> semua task project
    public function index(Project $project)
    {
        $tasks = $project->tasks()->with('user')->get();

        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    // POST /api/projects/{project}/tasks -> buat task baru
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:Pending,Done'
        ]);

        $task = $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->assigned_to,
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task berhasil dibuat!',
            'data' => $task
        ]);
    }

    // PUT /api/tasks/{task} -> update task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:Pending,Done'
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->assigned_to,
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task berhasil diupdate!',
            'data' => $task
        ]);
    }

    // DELETE /api/tasks/{task}
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task berhasil dihapus!'
        ]);
    }
}
