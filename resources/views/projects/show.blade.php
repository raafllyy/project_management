@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">

    <!-- ===== Header ===== -->
    <div class="mb-4">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('projects.index') }}">Proyek</a>
                </li>
                <li class="breadcrumb-item active">Detail Proyek</li>
            </ol>
        </nav>

        <h2 class="fw-bold text-dark mb-1">{{ $project->name }}</h2>
        <p class="text-muted mb-0">Informasi detail proyek dan progres task</p>
    </div>

    <div class="row">

        <!-- ===== LEFT : PROJECT INFO ===== -->
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm info-card mb-4">
                <div class="card-body">

                    <h6 class="fw-bold mb-3 text-uppercase text-secondary">
                        Informasi Proyek
                    </h6>

                    <div class="mb-3">
                        <small class="text-muted">Project Manager</small>
                        <div class="fw-semibold">
                            {{ optional($project->creator)->name ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Deadline</small>
                        <div class="fw-semibold">
                            {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Status</small>
                        <div class="mt-1">

                            @if($project->status === 'Pending')
                                <span class="badge badge-pending">Pending</span>

                            @elseif($project->status === 'Active')
                                <span class="badge badge-active">Active</span>

                            @else
                                <span class="badge badge-complete">Completed</span>
                            @endif

                        </div>
                    </div>

                    <!-- ===== PM ACTION ===== -->
                    @if(auth()->id() === $project->created_by && $project->status === 'Active')
                        <hr>
                        <form action="{{ route('projects.complete', $project->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button class="btn btn-success w-100">
                                Tandai Project Selesai
                            </button>
                        </form>
                    @endif

                </div>
            </div>

            <!-- ===== MEMBERS ===== -->
            <div class="card border-0 shadow-sm info-card">
                <div class="card-body">

                    <h6 class="fw-bold mb-3 text-uppercase text-secondary">
                        Anggota Tim
                    </h6>

                    <div class="d-flex flex-wrap gap-2">
                        @forelse($project->members as $member)
                            <span class="badge badge-member">
                                {{ $member->name }}
                            </span>
                        @empty
                            <span class="text-muted small">Belum ada anggota</span>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>

        <!-- ===== RIGHT : TASK LIST ===== -->
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm info-card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-uppercase text-secondary mb-0">
                            Daftar Task
                        </h6>

                        @if($project->status === 'Active')
                            <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}"
                               class="btn btn-primary btn-sm">
                                + Tambah Task
                            </a>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-dashboard align-middle">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Assigned</th>
                                    <th>Status</th>
                                    <th>Deadline</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($project->tasks as $task)
                                <tr>
                                    <td class="fw-semibold">{{ $task->title }}</td>
                                    <td>{{ optional($task->user)->name ?? '-' }}</td>
                                    <td>
                                        @if($task->status === 'Todo')
    <span class="badge badge-pending">Todo</span>

@elseif($task->status === 'In Progress')
    <span class="badge badge-progress">In Progress</span>

@elseif($task->status === 'Done')
    <span class="badge badge-complete">Done</span>
@endif

                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        Belum ada task
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<!-- ===== STYLE ===== -->
<style>

.info-card{
    border-radius:16px;
}

/* ===== STATUS BADGE (DASHBOARD STYLE) ===== */
.badge{
    font-size:0.75rem;
    font-weight:700;
    padding:6px 14px;
    border-radius:999px;
}

.badge-pending{
    background:#dbeafe;
    color:#1d4ed8;
}

.badge-active{
    background:#fee2e2;
    color:#b91c1c;
}

.badge-complete{
    background:#dcfce7;
    color:#166534;
}

.badge-progress{
    background:#e0e7ff;
    color:#4338ca;
}

.badge-member{
    background:#f3f4f6;
    color:#374151;
    font-weight:500;
}

/* ===== TABLE ===== */
.table-dashboard th{
    font-size:0.75rem;
    text-transform:uppercase;
    color:#6b7280;
    font-weight:700;
}

.table-dashboard td{
    padding:14px 10px;
}

/* ===== BUTTON ===== */
.btn-primary{
    background:linear-gradient(135deg,#667eea,#764ba2);
    border:none;
    border-radius:10px;
}

.btn-success{
    border-radius:10px;
}

</style>
@endsection
