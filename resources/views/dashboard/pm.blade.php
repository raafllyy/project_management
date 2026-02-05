@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Dashboard</h2>
        <p class="text-muted mb-0">Selamat datang kembali! Berikut ini adalah perkembangan terbaru mengenai proyek-proyek Anda hari ini..</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Projects -->
        <div class="col-lg-4 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon stat-icon-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                        <span class="badge badge-trend-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                            Active
                        </span>
                    </div>
                    <h3 class="stat-value mb-1">{{ $totalProjects }}</h3>
                    <p class="stat-label mb-0">Total Proyek</p>
                </div>
            </div>
        </div>

        <!-- Total Tasks -->
        <div class="col-lg-4 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon stat-icon-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                        </div>
                        <span class="badge badge-trend-neutral">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Ongoing
                        </span>
                    </div>
                    <h3 class="stat-value mb-1">{{ $totalTasks }}</h3>
                    <p class="stat-label mb-0">Total Tugas</p>
                </div>
            </div>
        </div>

        <!-- Progress -->
        <div class="col-lg-4 col-md-12">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon stat-icon-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <span class="badge badge-percentage">{{ $progress }}%</span>
                    </div>
                    <h3 class="stat-value mb-1">In Progress</h3>
                    <div class="progress-modern mt-3">
                        <div class="progress-bar-modern" style="width: {{ $progress }}%;">
                            <span class="progress-label">{{ $progress }}% Selesai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="card table-card border-0 shadow-sm">
        <div class="card-header bg-white border-0 pt-4 pb-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1">Proyek Anda</h5>
                    <p class="text-muted small mb-0">Berikut adalah semua proyek Anda dan detailnya</p>
                </div>
                <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    New Project
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            @if($projects->count() > 0)
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    Project Name
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    Deadline
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    Anggota Tim
                                </div>
                            </th>
                            <th class="text-center">Status</th>
                            <th class="pe-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr class="table-row-hover">
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="project-avatar">
                                        {{ strtoupper(substr($project->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">
    <a href="{{ route('projects.show', $project->id) }}" 
       class="text-dark text-decoration-none">
        {{ $project->name }}
    </a>
</div>

                                        <div class="small text-muted">Created {{ \Carbon\Carbon::parse($project->created_at)->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @php
                                        $deadline = \Carbon\Carbon::parse($project->deadline);
                                        $daysLeft = now()->diffInDays($deadline, false);
                                        $isUrgent = $daysLeft <= 7 && $daysLeft >= 0;
                                        $isOverdue = $daysLeft < 0;
                                    @endphp
                                    <span class="fw-medium {{ $isOverdue ? 'text-danger' : ($isUrgent ? 'text-warning' : 'text-dark') }}">
                                        {{ $deadline->format('d M Y') }}
                                    </span>
                                    @if($isOverdue)
                                        <span class="badge badge-danger-soft">Terlambat</span>
                                    @elseif($isUrgent)
                                        
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="avatar-group">
                                    @forelse($project->members->take(3) as $member)
                                        <div class="avatar-group-item" title="{{ $member->name }}">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </div>
                                    @empty
                                        <span class="text-muted small">Tidak ada anggota</span>
                                    @endforelse
                                    @if($project->members->count() > 3)
                                        <div class="avatar-group-item avatar-more">
                                            +{{ $project->members->count() - 3 }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">

    @if($project->status == 'Pending')
        <span class="badge badge-status-pending">Pending</span>

    @elseif($project->status == 'Active')
        <span class="badge badge-status-active">Active</span>

    @else
        <span class="badge badge-status-complete">Complete</span>
    @endif

</td>

                            <td class="pe-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-icon btn-icon-primary" title="Edit Project">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this project?')" class="btn btn-icon btn-icon-danger" title="Delete Project">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                <path d="M3 6h18"></path>
                                                <path d="M19 6l-1 14H6L5 6"></path>
                                                <path d="M10 11v6"></path>
                                                <path d="M14 11v6"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <!-- Empty State -->
            <div class="empty-state-table text-center py-5">
                <div class="empty-icon mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <h5 class="fw-bold text-dark mb-2">Belum ada proyek</h5>
                <p class="text-muted mb-4">Mulai dengan membuat proyek pertama Anda </p>
                <a href="{{ route('projects.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-2">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Create Your First Project
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Stats Cards */
.stat-card {
    border-radius: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid #e5e7eb !important;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1) !important;
}

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.stat-icon-purple {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 4px 14px rgba(102, 126, 234, 0.3);
}

.stat-icon-green {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
}

.stat-icon-orange {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    box-shadow: 0 4px 14px rgba(245, 158, 11, 0.3);
}

.stat-value {
    font-size: 2.25rem;
    font-weight: 700;
    color: #1f2937;
}

.stat-label {
    font-size: 0.9rem;
    color: #6b7280;
    font-weight: 500;
}

.badge-trend-up {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 0.35rem 0.65rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.badge-trend-neutral {
    background: #f3f4f6;
    color: #6b7280;
    padding: 0.35rem 0.65rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.badge-percentage {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    padding: 0.35rem 0.75rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 700;
}

/* Progress Bar */
.progress-modern {
    height: 12px;
    background: #f3f4f6;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.progress-bar-modern {
    height: 100%;
    background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
    border-radius: 10px;
    transition: width 0.6s ease;
    position: relative;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
}

.progress-label {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.65rem;
    font-weight: 600;
    color: white;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

/* Table Card */
.table-card {
    border-radius: 16px;
}

.table-modern {
    font-size: 0.9rem;
}

.table-modern thead {
    background: #f9fafb;
    border-bottom: 2px solid #e5e7eb;
}

.table-modern thead th {
    font-size: 0.8rem;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem;
    border: none;
}

.table-modern tbody td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f3f4f6;
}

.table-row-hover {
    transition: all 0.2s ease;
}

.table-row-hover:hover {
    background: #f9fafb;
}

.project-avatar {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1rem;
}

/* Avatar Group */
.avatar-group {
    display: flex;
    align-items: center;
    gap: -8px;
}

.avatar-group-item {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.75rem;
    border: 2px solid white;
    margin-left: -8px;
    transition: all 0.2s ease;
}

.avatar-group-item:first-child {
    margin-left: 0;
}

.avatar-group-item:hover {
    transform: translateY(-2px);
    z-index: 10;
}

.avatar-more {
    background: #f3f4f6;
    color: #6b7280;
    font-size: 0.7rem;
}


/* Status Badges */

/* ACTIVE = MERAH */
.badge-status-active {
    background: #fee2e2;
    color: #b91c1c;
    padding: 0.45rem 0.85rem;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.3px;
}

/* PENDING = BIRU */
.badge-status-pending {
    background: #dbeafe;
    color: #1d4ed8;
    padding: 0.45rem 0.85rem;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.3px;
}

/* COMPLETE = HIJAU */
.badge-status-complete {
    background: #dcfce7;
    color: #166534;
    padding: 0.45rem 0.85rem;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.3px;
}


.badge-danger-soft {
    background: #fee2e2;
    color: #991b1b;
    padding: 0.25rem 0.6rem;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
}

.badge-warning-soft {
    background: #fef3c7;
    color: #92400e;
    padding: 0.25rem 0.6rem;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
}

/* Action Buttons */
.btn-icon {
    width: 36px;
    height: 36px;
    padding: 0;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-icon-primary {
    background: #eff6ff;
    color: #2563eb;
}

.btn-icon-primary:hover {
    background: #2563eb;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.btn-icon-danger {
    background: #fef2f2;
    color: #dc2626;
}

.btn-icon-danger:hover {
    background: #dc2626;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

/* Primary Button */
.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 10px;
    padding: 0.6rem 1.25rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
}

/* Empty State */
.empty-state-table {
    padding: 4rem 2rem;
}

.empty-icon {
    color: #d1d5db;
    margin: 0 auto;
    width: fit-content;
}

/* Responsive */
@media (max-width: 768px) {
    .stat-value {
        font-size: 1.75rem;
    }
    
    .table-responsive {
        border-radius: 0;
    }
    
    .avatar-group-item {
        margin-left: -10px;
    }
}
</style>
@endsection