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
                <li class="breadcrumb-item active" aria-current="page">Create New Task</li>
            </ol>
        </nav>
        <h2 class="fw-bold text-dark mb-1">Buat Tugas Baru</h2>
        <p class="text-muted mb-0">Tambahkan tugas baru dan berikan ke anggota tim</p>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card form-card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <!-- Task Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark">
                                Judul Tugas
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
                                    value="{{ old('title') }}"
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
                                >{{ old('description') }}</textarea>
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
        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
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
    <option value="">Pilih Member</option>
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
                                        value="{{ old('deadline') }}"
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
    <option value="Todo" {{ old('status', 'Todo') == 'Todo' ? 'selected' : '' }}>To Do</option>
    <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
    <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
</select>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
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
                                Create Task
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#project_id').change(function() {
        let projectId = $(this).val();
        let memberSelect = $('#user_id');

        // Kosongkan dropdown dulu
        memberSelect.empty();
        memberSelect.append('<option value="">Pilih Member</option>');

        if(projectId) {
            $.get('/projects/' + projectId + '/members', function(data){
                data.forEach(function(member) {
                    memberSelect.append('<option value="'+member.id+'">'+member.name+'</option>');
                });
            });
        }
    });

    // Jika ada old('project_id'), load member otomatis
    let oldProjectId = "{{ old('project_id') }}";
    let oldUserId = "{{ old('user_id') }}";

    if(oldProjectId) {
        $.get('/projects/' + oldProjectId + '/members', function(data){
            let memberSelect = $('#user_id');
            data.forEach(function(member){
                let selected = member.id == oldUserId ? 'selected' : '';
                memberSelect.append('<option value="'+member.id+'" '+selected+'>'+member.name+'</option>');
            });
        });
    }
});
</script>

@endsection