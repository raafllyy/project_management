@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
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
                <li class="breadcrumb-item active" aria-current="page">Semua Tugas</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">Tugas Saya</h2>
                <p class="text-muted mb-0">Semua tugas yang ditugaskan ke kamu</p>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                    Filter Status
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('member.tasks') }}">Semua Tugas</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="?status=Todo"> To Do</a></li>
                    <li><a class="dropdown-item" href="?status=In Progress"> In Progress</a></li>
                    <li><a class="dropdown-item" href="?status=Done"> Done</a></li>
                </ul>
            </div>
        </div>
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

    <!-- Tasks Table -->
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
                                    Tugas
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
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                    </svg>
                                    Deskripsi
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
                            <th class="pe-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr class="table-row-hover">
                            <td class="ps-4">
                                <div class="fw-semibold text-dark">{{ $task->title }}</div>
                                <div class="small text-muted">Created {{ $task->created_at->format('d M Y') }}</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="project-dot"></div>
                                    <span class="fw-medium text-dark">{{ $task->project->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                @if($task->description)
                                    <span class="text-dark">{{ Str::limit($task->description, 50) }}</span>
                                @else
                                    <span class="text-muted">Tidak ada deskripsi</span>
                                @endif
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
                                    <button type="button" class="btn btn-icon btn-icon-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $task->id }}" title="Update Status">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Update Status Modal -->
                        <div class="modal fade" id="updateStatusModal{{ $task->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content modal-modern">
                                    <<form action="{{ route('member.tasks.updateStatus', $task) }}" method="POST">>
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <div>
                                                <h5 class="modal-title fw-bold">Update Task Status</h5>
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
                                                        <div class="small text-muted">{{ $task->project->name ?? 'N/A' }}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status Selection -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Select New Status</label>
                                                <div class="status-options">
                                                    <div class="status-option">
                                                        <input type="radio" class="status-radio" name="status" value="Todo" id="status_todo_{{ $task->id }}" {{ $task->status == 'Todo' ? 'checked' : '' }}>
                                                        <label class="status-label status-pending" for="status_todo_{{ $task->id }}">
                                                            <div class="status-icon"></div>
                                                            <div>
                                                                <div class="status-title">To Do</div>
                                                                <div class="status-desc">Belum dimulai</div>
                                                            </div>
                                                        </label>
                                                    </div>

                                                    <div class="status-option">
                                                        <input type="radio" class="status-radio" name="status" value="In Progress" id="status_progress_{{ $task->id }}" {{ $task->status == 'In Progress' ? 'checked' : '' }}>
                                                        <label class="status-label status-progress" for="status_progress_{{ $task->id }}">
                                                            <div class="status-icon"></div>
                                                            <div>
                                                                <div class="status-title">In Progress</div>
                                                                <div class="status-desc">Sedang bekerja</div>
                                                            </div>
                                                        </label>
                                                    </div>

                                                    <div class="status-option">
                                                        <input type="radio" class="status-radio" name="status" value="Done" id="status_done_{{ $task->id }}" {{ $task->status == 'Done' ? 'checked' : '' }}>
                                                        <label class="status-label status-completed" for="status_done_{{ $task->id }}">
                                                            <div class="status-icon"></div>
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
                                                <div class="small">Hanya bisa mengubah status tugasmu sendiri</div>
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
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer with Stats -->
            <div class="card-footer bg-white border-0 py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $tasks->count() }} tasks
                    </div>
                    <div>
                        @php
                            $completed = $tasks->where('status', 'Done')->count();
                            $total = $tasks->count();
                            $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
                        @endphp
                        <span class="badge badge-status-completed">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-1">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            {{ $completed }}/{{ $total }} completed ({{ $percentage }}%)
                        </span>
                    </div>
                </div>
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
                <h5 class="fw-bold text-dark mb-2">Tidak ada tugas</h5>
                <p class="text-muted mb-0">Tunggu sampai Project Manager mengassign tugasmu</p>
            </div>
            @endif
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

/* Alert */
.alert-modern {
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 1rem 1.25rem;
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

/* Modal */
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

/* Status Options */
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

/* Buttons */
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