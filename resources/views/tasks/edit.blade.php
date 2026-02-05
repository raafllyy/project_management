@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('tasks.index') }}" class="text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg>
                        Tasks
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Tugas</li>
            </ol>
        </nav>
        <h2 class="fw-bold text-dark mb-1">Edit Tugas</h2>
        <p class="text-muted mb-0">Update detail tugas dan penugasan</p>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card form-card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Task Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark">
                                Task Title
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group-modern">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                </span>
                                <input 
                                    type="text" 
                                    class="form-control form-control-modern @error('title') is-invalid @enderror" 
                                    id="title" 
                                    name="title" 
                                    value="{{ old('title', $task->title) }}"
                                    placeholder="Enter task title"
                                    required
                                    autofocus
                                >
                            </div>
                            @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">
                                Deskripsi Tugas
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <div class="input-group-modern">
                                <span class="input-icon input-icon-textarea">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                </span>
                                <textarea 
                                    class="form-control form-control-modern form-control-textarea @error('description') is-invalid @enderror" 
                                    id="description" 
                                    name="description" 
                                    rows="4"
                                    placeholder="Add task description, requirements, or notes..."
                                >{{ old('description', $task->description) }}</textarea>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Project Selection -->
                            <div class="col-md-6 mb-4">
                                <label for="project_id" class="form-label fw-semibold text-dark">
                                    Proyek
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <span class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                    </span>
                                    <select 
                                        class="form-control form-control-modern @error('project_id') is-invalid @enderror" 
                                        id="project_id" 
                                        name="project_id"
                                        required
                                    >
                                        <option value="">Select a project</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                                {{ $project->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('project_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Assign Member -->
                            <div class="col-md-6 mb-4">
                                <label for="user_id" class="form-label fw-semibold text-dark">
                                    Ditugaskan Kepada
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <span class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </span>
                                    <select 
                                        class="form-control form-control-modern @error('user_id') is-invalid @enderror" 
                                        id="user_id" 
                                        name="user_id"
                                        required
                                    >
                                        <option value="">Select a member</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Deadline -->
                            <div class="col-md-6 mb-4">
                                <label for="deadline" class="form-label fw-semibold text-dark">
                                    Deadline
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <span class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    </span>
                                    <input 
                                        type="date" 
                                        class="form-control form-control-modern @error('deadline') is-invalid @enderror" 
                                        id="deadline" 
                                        name="deadline"
                                        value="{{ old('deadline', $task->deadline) }}"
                                        required
                                    >
                                </div>
                                @error('deadline')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
<div class="col-md-6 mb-4">
    <label for="status" class="form-label fw-semibold text-dark">
        Status
        <span class="text-danger">*</span>
    </label>
    <div class="input-group-modern">
        <span class="input-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
        </span>
        <select 
            class="form-control form-control-modern @error('status') is-invalid @enderror" 
            id="status" 
            name="status"
            required
        >
            <option value="Todo" {{ old('status', $task->status) == 'Todo' ? 'selected' : '' }}>To Do</option>
            <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Done" {{ old('status', $task->status) == 'Done' ? 'selected' : '' }}>Done</option>
        </select>
    </div>
    @error('status')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

                        <!-- Current Assignment Info -->
                        <div class="info-box mb-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark mb-1">Tugas Saat Ini Ditugaskan Kepada</div>
                                    <div class="small text-muted">
                                        Tugas ini saat ini ditugaskan kepada <strong>{{ $task->user->name }}</strong> 
                                        di proyek <strong>{{ $task->project->name }}</strong>.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3 pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-submit flex-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-2">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                Update Tugas
                            </button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-cancel flex-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card danger-zone-card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-danger mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="me-2">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        Danger Zone
                    </h5>
                    <p class="text-muted mb-3">
                        Setelah dihapus, tugas ini tidak dapat dikembalikan. Apakah Anda yakin?
                    </p>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini? Aksi ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-2">
                                <path d="M3 6h18"></path>
                                <path d="M19 6l-1 14H6L5 6"></path>
                                <path d="M10 11v6"></path>
                                <path d="M14 11v6"></path>
                            </svg>
                            Hapus Tugas Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Form Card */
.form-card {
    border-radius: 16px;
    background: white;
}

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

/* Form Controls */
.form-label {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.input-group-modern {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    z-index: 10;
    display: flex;
    align-items: center;
}

.input-icon-textarea {
    top: 1rem;
    transform: none;
}

.form-control-modern {
    padding: 0.75rem 1rem 0.75rem 3rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.form-control-textarea {
    padding-top: 0.75rem;
}

.form-control-modern:focus {
    background: white;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.form-control-modern::placeholder {
    color: #9ca3af;
}

select.form-control-modern {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%239ca3af' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    padding-right: 3rem;
}

/* Info Box */
.info-box {
    background: #eff6ff;
    border: 2px solid #bfdbfe;
    border-radius: 12px;
    padding: 1rem;
}

.info-icon {
    color: #2563eb;
}

/* Buttons */
.btn-submit {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 12px;
    padding: 0.85rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
}

.btn-cancel {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 0.85rem 1.5rem;
    font-weight: 600;
    color: #6b7280;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    border-color: #d1d5db;
    background: #f9fafb;
    color: #374151;
}

/* Danger Zone */
.danger-zone-card {
    border-radius: 16px;
    background: white;
    border: 2px solid #fee2e2 !important;
}

.btn-delete {
    background: #ef4444;
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    background: #dc2626;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

/* Validation */
.is-invalid {
    border-color: #ef4444 !important;
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.85rem;
    margin-top: 0.5rem;
}
</style>
@endsection