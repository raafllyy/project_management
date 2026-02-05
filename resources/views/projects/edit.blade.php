@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('projects.index') }}" class="text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg>
                        Proyek
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Proyek</li>
            </ol>
        </nav>
        <h2 class="fw-bold text-dark mb-1">Edit Proyek</h2>
        <p class="text-muted mb-0">Update detail proyek dan anggota tim</p>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card form-card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('projects.update', $project) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Project Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">
                                Nama Proyek
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group-modern">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                </span>
                                <input 
                                    type="text" 
                                    class="form-control form-control-modern @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $project->name) }}"
                                    placeholder="Enter project name"
                                    required
                                    autofocus
                                >
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deadline -->
                        <div class="mb-4">
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
                                    value="{{ old('deadline', $project->deadline) }}"
                                    required
                                >
                            </div>
                            @error('deadline')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Team Members -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                Anggota Tim
                                <span class="text-muted small">(Optional)</span>
                            </label>
                            <div class="current-members mb-3">
                                <div class="small text-muted mb-2">Anggota saat ini:</div>
                                <div class="d-flex flex-wrap gap-2">
                                    @forelse($project->members as $member)
                                        <span class="badge badge-current-member">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                            </svg>
                                            {{ $member->name }}
                                        </span>
                                    @empty
                                        <span class="text-muted small">Belum ada anggota yang ditugaskan</span>
                                    @endforelse
                                </div>
                            </div>
                            
                            <div class="members-select-wrapper">
                                @foreach($members as $member)
                                <div class="form-check member-checkbox">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="members[]" 
                                        value="{{ $member->id }}" 
                                        id="member{{ $member->id }}"
                                        {{ in_array($member->id, old('members', $project->members->pluck('id')->toArray())) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="member{{ $member->id }}">
                                        <div class="member-info">
                                            <div class="member-avatar">
                                                {{ strtoupper(substr($member->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="member-name">{{ $member->name }}</div>
                                                <div class="member-email">{{ $member->email }}</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @error('members')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3 pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-submit flex-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-2">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                Update Project
                            </button>
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-cancel flex-fill">
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
                    <p class="text-muted mb-3">Setelah dihapus, proyek ini tidak dapat dikembalikan. Apakah Anda yakin?</p>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to delete this project? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-2">
                                <path d="M3 6h18"></path>
                                <path d="M19 6l-1 14H6L5 6"></path>
                                <path d="M10 11v6"></path>
                                <path d="M14 11v6"></path>
                            </svg>
                            Delete This Project
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

.form-control-modern {
    padding: 0.75rem 1rem 0.75rem 3rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.form-control-modern:focus {
    background: white;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.form-control-modern::placeholder {
    color: #9ca3af;
}

/* Current Members */
.current-members {
    background: #f0fdf4;
    border: 2px solid #86efac;
    border-radius: 12px;
    padding: 1rem;
}

.badge-current-member {
    background: #10b981;
    color: white;
    padding: 0.4rem 0.75rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
}

/* Member Checkboxes */
.members-select-wrapper {
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 1rem;
    max-height: 300px;
    overflow-y: auto;
}

.member-checkbox {
    background: white;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.member-checkbox:last-child {
    margin-bottom: 0;
}

.member-checkbox:hover {
    border-color: #667eea;
    background: #f3f4f6;
}

.member-checkbox .form-check-input {
    width: 20px;
    height: 20px;
    margin-top: 0.5rem;
    border: 2px solid #d1d5db;
    cursor: pointer;
}

.member-checkbox .form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.member-checkbox .form-check-label {
    cursor: pointer;
    width: 100%;
    margin-left: 0.5rem;
}

.member-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.member-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.9rem;
}

.member-name {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.95rem;
}

.member-email {
    font-size: 0.8rem;
    color: #6b7280;
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

/* Scrollbar */
.members-select-wrapper::-webkit-scrollbar {
    width: 6px;
}

.members-select-wrapper::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 10px;
}

.members-select-wrapper::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 10px;
}

.members-select-wrapper::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}
</style>
@endsection