@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Tugas</h2>
            <p class="text-muted mb-0">Manajemen semua tugas di seluruh proyek</p>
        </div>
        @role('Project Manager')
        <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-create d-flex align-items-center gap-2 px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14"></path>
            </svg>
            <span class="fw-semibold">Create Task</span>
        </a>
        @endrole
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-modern d-flex align-items-center mb-4" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <!-- Tasks Table Card -->
    <div class="card table-card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($tasks->count() > 0)
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
                                    Task Title
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    Proyek
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    Ditugaskan Kepada
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
                            @role('Project Manager')
                            <th class="pe-4 text-end">Actions</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr class="table-row-hover">
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="task-checkbox">
                                        <input type="checkbox" class="form-check-input" {{ $task->status === 'completed' ? 'checked' : '' }}>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark {{ $task->status === 'completed' ? 'text-decoration-line-through text-muted' : '' }}">
                                            {{ $task->title }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="project-dot"></div>
                                    <span class="fw-medium text-dark">{{ $task->project->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="member-avatar-small">
                                        {{ strtoupper(substr($task->user->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $task->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    $deadline = \Carbon\Carbon::parse($task->deadline);
                                    $daysLeft = now()->diffInDays($deadline, false);
                                    $isUrgent = $daysLeft <= 3 && $daysLeft >= 0;
                                    $isOverdue = $daysLeft < 0;
                                @endphp
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-medium {{ $isOverdue ? 'text-danger' : ($isUrgent ? 'text-warning' : 'text-dark') }}">
                                        {{ $deadline->format('d M Y') }}
                                    </span>
                                    @if($isOverdue && $task->status !== 'completed')
                                        <span class="badge badge-danger-soft">Overdue</span>
                                    @elseif($isUrgent && $task->status !== 'completed')
                                        <span class="badge badge-warning-soft">Urgent</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                @php
                                   $statusConfig = [
    'Todo' => [
        'class' => 'badge-status-pending',
        'icon' => '',
        'text' => 'To Do'
    ],
    'In Progress' => [
        'class' => 'badge-status-progress',
        'icon' => '',
        'text' => 'In Progress'
    ],
    'Done' => [
        'class' => 'badge-status-completed',
        'icon' => '',
        'text' => 'Done'
    ],
];

$config = $statusConfig[$task->status] ?? [
    'class' => 'badge-status-pending',
    'icon' => '•',
    'text' => $task->status
];



                                    $config = $statusConfig[$task->status] ?? ['class' => 'badge-status-to_do', 'icon' => '•', 'text' => ucfirst($task->status)];
                                @endphp
                                <span class="badge {{ $config['class'] }}">
                                    <span class="badge-icon">{{ $config['icon'] }}</span>
                                    {{ $config['text'] }}
                                </span>
                            </td>
                            @role('Project Manager')
                            <td class="pe-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-icon btn-icon-primary" title="Edit Task">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')" class="btn btn-icon btn-icon-danger" title="Delete Task">
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
                            @endrole
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
                <h5 class="fw-bold text-dark mb-2">Belum Ada Tugas</h5>
                <p class="text-muted mb-4">Ayo buat tugas pertama Anda untuk melihat progress</p>
                @role('Project Manager')
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-2">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Buat Tugas Pertama Anda
                </a>
                @endrole
            </div>
            @endif
        </div>
    </div>
</div>

<style>
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

/* Task Checkbox */
.task-checkbox .form-check-input {
    width: 20px;
    height: 20px;
    border: 2px solid #d1d5db;
    border-radius: 6px;
    cursor: pointer;
}

.task-checkbox .form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
}

/* Project Dot */
.project-dot {
    width: 10px;
    height: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
}

/* Member Avatar Small */
.member-avatar-small {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.75rem;
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
    border-radius: 6px;
    font-size: 0.7rem;
}

.badge-warning-soft {
    background: #fef3c7;
    color: #92400e;
    padding: 0.25rem 0.6rem;
    border-radius: 6px;
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

/* Create Button */
.btn-create {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.btn-create:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
    background: linear-gradient(135deg, #5568d3 0%, #6a3f91 100%);
}

/* Alert */
.alert-modern {
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 1rem 1.25rem;
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

/* Responsive */
@media (max-width: 768px) {
    .btn-create span {
        display: none;
    }
}
</style>
@endsection