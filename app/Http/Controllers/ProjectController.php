<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // KITA HAPUS CONSTRUCT YANG ERROR TADI

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Project Manager')) {
            $projects = Project::where('created_by', $user->id)->with('members')->latest()->get();
        } elseif ($user->hasRole('Member')) {
            // Member hanya lihat proyek di mana dia jadi anggota
            $projects = Project::whereHas('members', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with('members')->latest()->get();
        } else {
            $projects = Project::with('members')->latest()->get();
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

    public function show(Project $project)
    {
        // Proteksi manual untuk Member agar tidak bisa ngintip project orang lewat URL
        if (Auth::user()->hasRole('Member')) {
            if (!$project->members()->where('user_id', Auth::id())->exists()) {
                abort(403, 'Anda bukan anggota proyek ini.');
            }
        }

        $project->load(['members', 'creator', 'tasks.user']);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $members = User::role('Member')->get();
        $assignedMembers = $project->members->pluck('id')->toArray();
        return view('projects.edit', compact('project', 'members', 'assignedMembers'));
    }

    public function update(Request $request, Project $project)
    {
        $project->update($request->only(['name', 'description', 'deadline']));
        if ($request->members) {
            $project->members()->sync($request->members);
        }
        return redirect()->route('projects.index')->with('success', 'Project diupdate!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project dihapus!');
    }
}