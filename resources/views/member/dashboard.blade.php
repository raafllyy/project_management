@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Dashboard Member</h2>
        <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->name }}! Disini adalah ringkasan tugas Anda</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Tasks -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon stat-icon-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                        </div>
                        <span class="badge badge-trend-neutral">My Tasks</span>
                    </div>
                    <h3 class="stat-value mb-1">{{ $tasks ?? 0 }}</h3>
                    <p class="stat-label mb-0">Tugas Saya</p>
                </div>
            </div>
        </div>

        <!-- Completed Tasks -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon stat-icon-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <span class="badge badge-trend-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                            Done
                        </span>
                    </div>
                    <h3 class="stat-value mb-1">{{ $doneTasks ?? 0 }}</h3>
                    <p class="stat-label mb-0">Tugas Selesai</p>
                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon stat-icon-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <span class="badge badge-warning-custom">In Progress</span>
                    </div>
                    <h3 class="stat-value mb-1">{{ ($tasks ?? 0) - ($doneTasks ?? 0) }}</h3>
                    <p class="stat-label mb-0">Tugas Aktif</p>
                </div>
            </div>
        </div>

        <!-- Progress Percentage -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon stat-icon-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <line x1="12" y1="20" x2="12" y2="10"></line>
                                <line x1="18" y1="20" x2="18" y2="4"></line>
                                <line x1="6" y1="20" x2="6" y2="16"></line>
                            </svg>
                        </div>
                        @php
                            $progress = ($tasks ?? 0) > 0 ? round((($doneTasks ?? 0) / ($tasks ?? 1)) * 100) : 0;
                        @endphp
                        <span class="badge badge-percentage">{{ $progress }}%</span>
                    </div>
                    <h3 class="stat-value mb-1">{{ $progress }}%</h3>
                    <p class="stat-label mb-0">Persentase Penyelesaian</p>
                    <div class="progress-modern mt-3">
                        <div class="progress-bar-modern" style="width: {{ $progress }}%;">
                            <span class="progress-label">{{ $progress }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tasks -->
    <div class="card table-card border-0 shadow-sm">
        <div class="card-header bg-white border-0 pt-4 pb-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1">Tugas Terakhir</h5>
                    <p class="text-muted small mb-0">Tugas terbaru yang Anda assign</p>
                </div>
                <a href="{{ route('member.tasks') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-2">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            @php
                use App\Models\Task;
                $recentTasks = Task::where('user_id', auth()->id())
                    ->with('project')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
            @endphp
            
            @if($recentTasks->count() > 0)
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    Task
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    Project
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
                            <th class="text-center">Status</th>
                            <th class="pe-4 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTasks as $task)
                        <tr class="table-row-hover">
                            <td class="ps-4">
                                <div class="fw-semibold text-dark">{{ $task->title }}</div>
                                @if($task->description)
                                <div class="small text-muted">{{ Str::limit($task->description, 40) }}</div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="project-dot"></div>
                                    <span class="fw-medium text-dark">{{ $task->project->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    $deadline = \Carbon\Carbon::parse($task->deadline);
                                    $daysLeft = now()->diffInDays($deadline, false);
                                    $isOverdue = $daysLeft < 0;
                                    $isUrgent = $daysLeft <= 3 && $daysLeft >= 0;
                                @endphp
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-medium {{ $isOverdue ? 'text-danger' : ($isUrgent ? 'text-warning' : 'text-dark') }}">
                                        {{ $deadline->format('d M Y') }}
                                    </span>
                                    @if($isOverdue && $task->status != 'Done')
                                        <span class="badge badge-danger-soft">Overdue</span>
                                    @elseif($isUrgent && $task->status != 'Done')
                                        <span class="badge badge-warning-soft">{{ $daysLeft }}d left</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                @php
                                    $statusConfig = [
                                        'Todo' => ['class' => 'badge-status-pending', 'icon' => '', 'text' => 'To Do'],
                                        'In Progress' => ['class' => 'badge-status-progress', 'icon' => '', 'text' => 'In Progress'],
                                        'Done' => ['class' => 'badge-status-completed', 'icon' => '', 'text' => 'Done'],
                                    ];
                                    $config = $statusConfig[$task->status] ?? ['class' => 'badge-status-pending', 'icon' => '•', 'text' => $task->status];
                                @endphp
                                <span class="badge {{ $config['class'] }}">
                                    <span class="badge-icon">{{ $config['icon'] }}</span>
                                    {{ $config['text'] }}
                                </span>
                            </td>
                            <td class="pe-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('member.tasks') }}" class="btn btn-icon btn-icon-primary" title="View Details">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
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
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                </div>
                <h5 class="fw-bold text-dark mb-2">Belum ada tugas</h5>
                <p class="text-muted mb-0">Tunggu sampai Project Manager assign tugas kemu</p>
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

.stat-icon-blue {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    box-shadow: 0 4px 14px rgba(59, 130, 246, 0.3);
}

.stat-icon-green {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
}

.stat-icon-orange {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    box-shadow: 0 4px 14px rgba(245, 158, 11, 0.3);
}

.stat-icon-purple {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    box-shadow: 0 4px 14px rgba(139, 92, 246, 0.3);
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
}

.badge-warning-custom {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    padding: 0.35rem 0.65rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 600;
}

.badge-percentage {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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
    background: linear-gradient(90deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 10px;
    transition: width 0.6s ease;
    position: relative;
    box-shadow: 0 2px 8px rgba(139, 92, 246, 0.3);
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

/* Table */
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

.project-dot {
    width: 10px;
    height: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
}

/* Status Badges */
.badge {
    padding: 0.45rem 0.85rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}

.badge-icon {
    font-size: 0.85rem;
}

.badge-status-pending {
    background: #fef3c7;
    color: #92400e;
}

.badge-status-progress {
    background: #dbeafe;
    color: #1e40af;
}

.badge-status-completed {
    background: #d1fae5;
    color: #065f46;
}

.badge-danger-soft {
    background: #fee2e2;
    color: #991b1b;
    padding: 0.25rem 0.6rem;
    font-size: 0.7rem;
}

.badge-warning-soft {
    background: #fef3c7;
    color: #92400e;
    padding: 0.25rem 0.6rem;
    font-size: 0.7rem;
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
</style>
@endsection