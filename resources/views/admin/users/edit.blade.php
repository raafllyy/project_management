@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('users.index') }}" class="text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg>
                        Users
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
        <h2 class="fw-bold text-dark mb-1">Edit User</h2>
        <p class="text-muted mb-0">Update informasi pengguna dan peran</p>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card form-card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Current User Info -->
                        <div class="info-box mb-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="user-avatar-large">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark mb-1">Pengguna Saat Ini: {{ $user->name }}</div>
                                    <div class="small text-muted">
                                        Email: {{ $user->email }} • 
                                        Role: @if($user->hasRole('Admin'))
                                            <span class="text-danger">Admin</span>
                                        @elseif($user->hasRole('Project Manager'))
                                            <span class="text-primary">Project Manager</span>
                                        @else
                                            <span class="text-success">Member</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">
                                Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group-modern">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <input 
                                    type="text" 
                                    class="form-control form-control-modern @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Enter full name"
                                    required
                                    autofocus
                                >
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-dark">
                                Email Address
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group-modern">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </span>
                                <input 
                                    type="email" 
                                    class="form-control form-control-modern @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="user@example.com"
                                    required
                                >
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Section -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                Ubah Password
                                <span class="text-muted small">(Kosongkan untuk tetap menggunakan password lama)</span>
                            </label>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="input-group-modern">
                                        <span class="input-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg>
                                        </span>
                                        <input 
                                            type="password" 
                                            class="form-control form-control-modern @error('password') is-invalid @enderror" 
                                            id="password" 
                                            name="password"
                                            placeholder="Masukkan password baru"
                                        >
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="input-group-modern">
                                        <span class="input-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg>
                                        </span>
                                        <input 
                                            type="password" 
                                            class="form-control form-control-modern" 
                                            id="password_confirmation" 
                                            name="password_confirmation"
                                            placeholder="Konfirmasi password baru"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                User Role
                                <span class="text-danger">*</span>
                            </label>
                            <div class="role-selection">
                                <div class="role-option">
                                    <input 
                                        type="radio" 
                                        class="form-check-input" 
                                        name="role" 
                                        value="Admin" 
                                        id="roleAdmin"
                                        {{ old('role', $user->getRoleNames()->first()) == 'Admin' ? 'checked' : '' }}
                                    >
                                    <label class="role-label" for="roleAdmin">
                                        <div class="role-icon role-icon-admin">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8 0a.5.5 0 0 1 .5.5v1.308a7.001 7.001 0 0 1 5.717 5.717h1.308a.5.5 0 0 1 0 1h-1.308a7.001 7.001 0 0 1-5.717 5.717V15.5a.5.5 0 0 1-1 0v-1.308a7.001 7.001 0 0 1-5.717-5.717H.5a.5.5 0 0 1 0-1h1.308a7.001 7.001 0 0 1 5.717-5.717V.5A.5.5 0 0 1 8 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="role-title">Administrator</div>
                                            <div class="role-description">Full system access and user management</div>
                                        </div>
                                    </label>
                                </div>

                                <div class="role-option">
                                    <input 
                                        type="radio" 
                                        class="form-check-input" 
                                        name="role" 
                                        value="Project Manager" 
                                        id="rolePM"
                                        {{ old('role', $user->getRoleNames()->first()) == 'Project Manager' ? 'checked' : '' }}
                                    >
                                    <label class="role-label" for="rolePM">
                                        <div class="role-icon role-icon-pm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="role-title">Project Manager</div>
                                            <div class="role-description">Mengelola proyek dan mengatur tugas</div>
                                        </div>
                                    </label>
                                </div>

                                <div class="role-option">
                                    <input 
                                        type="radio" 
                                        class="form-check-input" 
                                        name="role" 
                                        value="Member" 
                                        id="roleMember"
                                        {{ old('role', $user->getRoleNames()->first()) == 'Member' ? 'checked' : '' }}
                                    >
                                    <label class="role-label" for="roleMember">
                                        <div class="role-icon role-icon-member">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="role-title">Member</div>
                                            <div class="role-description">Melihat dan menyelesaikan tugas yang ditugaskan</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @error('role')
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
                                Update User
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-cancel flex-fill">
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

            <!-- Danger Zone (only if not editing self) -->
            @if($user->id !== auth()->id())
            <div class="card danger-zone-card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-danger mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="me-2">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        Danger Zone
                    </h5>
                    <p class="text-muted mb-3">Setelah pengguna ini dihapus, tidak ada yang bisa mengembalikan data mereka. Semua data pengguna ini akan dihapus secara permanen.</p>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to delete this user? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="me-2">
                                <path d="M3 6h18"></path>
                                <path d="M19 6l-1 14H6L5 6"></path>
                                <path d="M10 11v6"></path>
                                <path d="M14 11v6"></path>
                            </svg>
                            Delete This User
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Same styling as create page */
.form-card {
    border-radius: 16px;
    background: white;
}

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

.info-box {
    background: #eff6ff;
    border: 2px solid #bfdbfe;
    border-radius: 12px;
    padding: 1rem;
}

.user-avatar-large {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.5rem;
    box-shadow: 0 4px 14px rgba(102, 126, 234, 0.3);
}

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

.role-selection {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.role-option {
    position: relative;
}

.role-option .form-check-input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.role-label {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.role-label:hover {
    border-color: #667eea;
    background: white;
}

.role-option .form-check-input:checked ~ .role-label {
    border-color: #667eea;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.role-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.role-icon-admin {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.role-icon-pm {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

.role-icon-member {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.role-title {
    font-weight: 600;
    color: #1f2937;
    font-size: 1rem;
    margin-bottom: 0.25rem;
}

.role-description {
    font-size: 0.85rem;
    color: #6b7280;
}

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