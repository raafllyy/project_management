@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header with Breadcrumb -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('member.dashboard') }}" class="text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('member.tasks') }}" class="text-decoration-none">Tugas Saya</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Detail Tugas</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">Task Details</h2>
                <p class="text-muted mb-0">Detail tugas ini</p>
            </div>
            <a href="{{ route('member.tasks') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                 Kembali ke Tugas
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Task Card -->
        <div class="col-lg-8">
            <div class="card detail-card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-3 px-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="fw-bold text-dark mb-2">{{ $task->title }}</h3>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <!-- Status Badge -->
                                @php
                                    $statusConfig = [
                                        'Todo' => ['class' => 'badge-status-pending', 'icon' => '', 'text' => 'To Do'],
                                        'In Progress' => ['class' => 'badge-status-progress', 'icon' => '', 'text' => 'In Progress'],
                                        'Done' => ['class' => 'badge-status-completed', 'icon' => '✓', 'text' => 'Done'],
                                    ];
                                    $config = $statusConfig[$task->status] ?? ['class' => 'badge-status-pending', 'icon' => '•', 'text' => $task->status];
                                @endphp
                                <span class="badge {{ $config['class'] }}">
                                    <span class="badge-icon">{{ $config['icon'] }}</span>
                                    {{ $config['text'] }}
                                </span>

                                <!-- Created Date -->
                                <span class="text-muted small">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    Created {{ $task->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-1">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                            </svg>
                            Update Status
                        </button>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Description Section -->
                    <div class="detail-section mb-4">
                        <div class="section-header mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <line x1="10" y1="9" x2="8" y2="9"></line>
                            </svg>
                            <h5 class="mb-0">Description</h5>
                        </div>
                        <div class="description-content">
                            @if($task->description)
                                <p class="text-dark mb-0">{{ $task->description }}</p>
                            @else
                                <p class="text-muted fst-italic mb-0">Tugas ini tidak memiliki deskripsi.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Activity Timeline (Optional) -->
                    <div class="detail-section">
                        <div class="section-header mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                            <h5 class="mb-0">Activity</h5>
                        </div>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker timeline-marker-success"></div>
                                <div class="timeline-content">
                                    <div class="fw-semibold text-dark">Task Created</div>
                                    <div class="small text-muted">{{ $task->created_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                            @if($task->updated_at != $task->created_at)
                            <div class="timeline-item">
                                <div class="timeline-marker timeline-marker-info"></div>
                                <div class="timeline-content">
                                    <div class="fw-semibold text-dark">Last Updated</div>
                                    <div class="small text-muted">{{ $task->updated_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar with Task Info -->
        <div class="col-lg-4">
            <!-- Project Info Card -->
            <div class="card info-card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="info-header mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <h6 class="mb-0">Project</h6>
                    </div>
                    <div class="project-badge">
                        <div class="project-icon">
                            {{ strtoupper(substr($task->project->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-semibold text-dark">{{ $task->project->name }}</div>
                            <div class="small text-muted">Detail Proyek</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deadline Info Card -->
            <div class="card info-card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="info-header mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <h6 class="mb-0">Deadline</h6>
                    </div>
                    @php
                        $deadline = \Carbon\Carbon::parse($task->deadline);
                        $daysLeft = now()->diffInDays($deadline, false);
                        $isOverdue = $daysLeft < 0;
                        $isUrgent = $daysLeft <= 3 && $daysLeft >= 0;
                    @endphp
                    <div class="deadline-info {{ $isOverdue ? 'deadline-overdue' : ($isUrgent ? 'deadline-urgent' : 'deadline-normal') }}">
                        <div class="deadline-date">{{ $deadline->format('d M Y') }}</div>
                        <div class="deadline-time">{{ $deadline->format('H:i') }}</div>
                        @if($isOverdue && $task->status != 'Done')
                            <div class="deadline-badge badge-overdue">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                Overdue by {{ abs($daysLeft) }} days
                            </div>
                        @elseif($isUrgent && $task->status != 'Done')
                            <div class="deadline-badge badge-urgent">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                {{ $daysLeft }} days remaining
                            </div>
                        @else
                            <div class="deadline-badge badge-normal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                {{ $daysLeft > 0 ? $daysLeft . ' days remaining' : 'Due today' }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card info-card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="info-header mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="12" cy="5" r="1"></circle>
                            <circle cx="12" cy="19" r="1"></circle>
                        </svg>
                        <h6 class="mb-0">Quick Actions</h6>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-action" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                            </svg>
                            Update Status
                        </button>
                        <a href="{{ route('member.tasks') }}" class="btn btn-outline-secondary btn-action">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            Lihat Semua Tugas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-modern">
            <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold">Update Tugas Status</h5>
                        <p class="text-muted small mb-0">Ubah status tugasmu</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Task Info -->
                    <div class="task-info-box mb-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="task-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold text-dark mb-1">{{ $task->title }}</div>
                                <div class="small text-muted">{{ $task->project->name }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Selection -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select New Status</label>
                        <div class="status-options">
                            <div class="status-option">
                                <input type="radio" class="status-radio" name="status" value="Todo" id="status_todo" {{ $task->status == 'Todo' ? 'checked' : '' }}>
                                <label class="status-label status-pending" for="status_todo">
                                    <div class="status-icon"></div>
                                    <div>
                                        <div class="status-title">To Do</div>
                                        <div class="status-desc">Belum dimulai</div>
                                    </div>
                                </label>
                            </div>

                            <div class="status-option">
                                <input type="radio" class="status-radio" name="status" value="In Progress" id="status_progress" {{ $task->status == 'In Progress' ? 'checked' : '' }}>
                                <label class="status-label status-progress" for="status_progress">
                                    <div class="status-icon"></div>
                                    <div>
                                        <div class="status-title">In Progress</div>
                                        <div class="status-desc">Sedang bekerja</div>
                                    </div>
                                </label>
                            </div>

                            <div class="status-option">
                                <input type="radio" class="status-radio" name="status" value="Done" id="status_done" {{ $task->status == 'Done' ? 'checked' : '' }}>
                                <label class="status-label status-completed" for="status_done">
                                    <div class="status-icon">✓</div>
                                    <div>
                                        <div class="status-title">Done</div>
                                        <div class="status-desc">Tugas selesai</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info-custom d-flex align-items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                        <div class="small">Status updates will be saved immediately</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-1">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Breadcrumb */
.breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 1rem;
}

.breadcrumb-item a {
    color: #667eea;
    font-weight: 500;
}

.breadcrumb-item.active {
    color: #6b7280;
}

/* Cards */
.detail-card, .info-card {
    border-radius: 16px;
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

/* Detail Sections */
.detail-section {
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #f3f4f6;
}

.detail-section:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #667eea;
}

.section-header h5 {
    font-weight: 700;
    color: #1f2937;
}

.description-content {
    background: #f9fafb;
    padding: 1.25rem;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    line-height: 1.7;
}

/* Timeline */
.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline-item {
    position: relative;
    padding-bottom: 1.5rem;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -1.5rem;
    top: 1.5rem;
    bottom: -0.5rem;
    width: 2px;
    background: #e5e7eb;
}

.timeline-item:last-child::before {
    display: none;
}

.timeline-marker {
    position: absolute;
    left: -1.75rem;
    top: 0.25rem;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 0 0 2px currentColor;
}

.timeline-marker-success {
    color: #10b981;
}

.timeline-marker-info {
    color: #3b82f6;
}

/* Info Header */
.info-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #667eea;
}

.info-header h6 {
    font-weight: 700;
    color: #1f2937;
}

/* Project Badge */
.project-badge {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border-radius: 12px;
}

.project-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.2rem;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

/* Deadline Info */
.deadline-info {
    padding: 1.25rem;
    border-radius: 12px;
    text-align: center;
}

.deadline-normal {
    background: #f0fdf4;
    border: 2px solid #86efac;
}

.deadline-urgent {
    background: #fef3c7;
    border: 2px solid #fcd34d;
}

.deadline-overdue {
    background: #fee2e2;
    border: 2px solid #fca5a5;
}

.deadline-date {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.deadline-time {
    font-size: 1rem;
    color: #6b7280;
    margin-bottom: 0.75rem;
}

.deadline-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
}

.badge-normal {
    background: #10b981;
    color: white;
}

.badge-urgent {
    background: #f59e0b;
    color: white;
}

.badge-overdue {
    background: #ef4444;
    color: white;
}

/* Action Buttons */
.btn-action {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    border-width: 2px;
}

.btn-action:hover {
    transform: translateY(-2px);
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

.btn-outline-secondary {
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-weight: 600;
    color: #6b7280;
}

.btn-outline-secondary:hover {
    background: #f9fafb;
    border-color: #d1d5db;
    color: #374151;
}

/* Modal Styles (Same as before) */
.modal-modern .modal-header {
    background: #f9fafb;
    border-bottom: 2px solid #e5e7eb;
    padding: 1.5rem;
    border-radius: 16px 16px 0 0;
}

.modal-modern .modal-content {
    border-radius: 16px;
    border: none;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.task-info-box {
    background: #eff6ff;
    border: 2px solid #bfdbfe;
    border-radius: 12px;
    padding: 1rem;
}

.task-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.status-options {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.status-option {
    position: relative;
}

.status-radio {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.status-label {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.status-label:hover {
    border-color: #667eea;
    background: white;
}

.status-radio:checked ~ .status-label {
    border-color: #667eea;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.status-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.status-pending .status-icon {
    background: #fef3c7;
}

.status-progress .status-icon {
    background: #dbeafe;
}

.status-completed .status-icon {
    background: #d1fae5;
}

.status-title {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.95rem;
}

.status-desc {
    font-size: 0.8rem;
    color: #6b7280;
}

.alert-info-custom {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #1e40af;
    border-radius: 10px;
    padding: 0.75rem;
}
</style>
@endsection