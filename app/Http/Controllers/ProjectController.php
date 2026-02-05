<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Project Manager')) {
            $projects = Project::where('created_by', Auth::id())
                ->with('members')
                ->get();
        } else {
            $projects = Project::with('members')->get();
        }

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $members = User::role('Member')->get();
        return view('projects.create', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'members' => 'nullable|array',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'created_by' => Auth::id(),
            'status' => 'Active'
        ]);

        if ($request->members) {
            $project->members()->sync($request->members);
        }

        return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat!');
    }

    public function edit(Project $project)
    {
        $members = User::role('Member')->get();
        $assignedMembers = $project->members->pluck('id')->toArray();

        return view('projects.edit', compact('project', 'members', 'assignedMembers'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'members' => 'nullable|array',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        if ($request->members) {
            $project->members()->sync($request->members);
        }

        return redirect()->route('projects.index')->with('success', 'Project berhasil diupdate!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus!');
    }

    // ⭐ COMPLETE PROJECT
    public function complete(Project $project)
    {
        if ($project->progress() < 100) {
            return back()->with('error', 'Semua task belum selesai!');
        }

        $project->update([
            'status' => 'Completed'
        ]);

        return back()->with('success', 'Project selesai!');
    }

public function show(Project $project)
{
    $project->load(['members', 'creator', 'tasks.user']);

    return view('projects.show', compact('project'));
}
}