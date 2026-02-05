<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectApiController extends Controller
{
    // 1. GET /api/projects -> list semua project
    public function index()
{
    // Coba kembalikan pesan simpel dulu
    return response()->json([
        'message' => 'Koneksi API Berhasil!',
        'data' => []
    ]);
}

    // 2. GET /api/projects/{id} -> detail project
    public function show(Project $project)
    {
        $project->load('members', 'creator', 'tasks.user');

        return response()->json([
            'success' => true,
            'data' => $project
        ]);
    }

    // 3. POST /api/projects -> create project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'members' => 'nullable|array'
        ]);

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'created_by' => Auth::id(),
            'status' => 'Active'
        ]);

        if($request->members){
            $project->members()->sync($request->members);
        }

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dibuat!',
            'data' => $project->load('members')
        ]);
    }

    // 4. PUT /api/projects/{id} -> update project
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'members' => 'nullable|array'
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline
        ]);

        if($request->members){
            $project->members()->sync($request->members);
        }

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil diupdate!',
            'data' => $project->load('members')
        ]);
    }

    // 5. DELETE /api/projects/{id} -> delete project
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dihapus!'
        ]);
    }
}
