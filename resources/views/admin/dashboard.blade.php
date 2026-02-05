@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Admin Dashboard</h2>
            <p class="text-muted mb-0">Ringkasan Statistik dan Aktivitas Sistem</p>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-primary btn-create d-flex align-items-center gap-2 px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="8.5" cy="7" r="4"></circle>
                <path d="M20 8v6"></path>
                <path d="M23 11h-6"></path>
            </svg>
            <span class="fw-semibold">Manajemen User</span>
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm stats-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Total Users</h6>
                            <h2 class="fw-bold mb-0">{{ $totalUsers }}</h2>
                            <div class="d-flex align-items-center mt-2">
                                <div class="text-success small fw-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
                                    </svg>
                                     Semua User Sistem
                                </div>
                            </div>
                        </div>
                        <div class="stats-icon bg-primary-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm stats-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Project Managers</h6>
                            <h2 class="fw-bold mb-0">{{ $totalPM }}</h2>
                            <div class="d-flex align-items-center mt-2">
                                <div class="text-warning small fw-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                    Pemimpin Tim
                                </div>
                            </div>
                        </div>
                        <div class="stats-icon bg-warning-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <polyline points="17 11 19 13 23 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm stats-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Members</h6>
                            <h2 class="fw-bold mb-0">{{ $totalMembers }}</h2>
                            <div class="d-flex align-items-center mt-2">
                                <div class="text-success small fw-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                    Anggota Tim
                                </div>
                            </div>
                        </div>
                        <div class="stats-icon bg-success-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm stats-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Total Projects</h6>
                            <h2 class="fw-bold mb-0">{{ $totalProjects }}</h2>
                            <div class="d-flex align-items-center mt-2">
                                <div class="text-info small fw-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                     Proyek Aktif
                                </div>
                            </div>
                        </div>
                        <div class="stats-icon bg-info-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users & Quick Stats -->
    <div class="row g-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm table-card">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Recent Users</h5>
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-primary">
                            View All
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="ms-1">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            User
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex align-items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                            Email
                                        </div>
                                    </th>
                                    <th>Role</th>
                                    <th class="pe-4">Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentUsers ?? [] as $user)
                                <tr class="table-row-hover">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="user-avatar-small">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                                <div class="small text-muted">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-dark">{{ $user->email }}</td>
                                    <td>
                                        @if($user->hasRole('Admin'))
                                            <span class="badge badge-role-admin">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                                                    <path d="M8 0a.5.5 0 0 1 .5.5v1.308a7.001 7.001 0 0 1 5.717 5.717h1.308a.5.5 0 0 1 0 1h-1.308a7.001 7.001 0 0 1-5.717 5.717V15.5a.5.5 0 0 1-1 0v-1.308a7.001 7.001 0 0 1-5.717-5.717H.5a.5.5 0 0 1 0-1h1.308a7.001 7.001 0 0 1 5.717-5.717V.5A.5.5 0 0 1 8 0z"/>
                                                </svg>
                                                Admin
                                            </span>
                                        @elseif($user->hasRole('Project Manager'))
                                            <span class="badge badge-role-pm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                </svg>
                                                Project Manager
                                            </span>
                                        @else
                                            <span class="badge badge-role-member">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                                </svg>
                                                Member
                                            </span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-muted">{{ $user->created_at->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        Tidak Menemukan User
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="fw-bold mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        <a href="{{ route('users.create') }}" class="btn btn-action btn-primary-action">
                            <div class="d-flex align-items-center">
                                <div class="action-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="20" y1="8" x2="20" y2="14"></line>
                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                    </svg>
                                </div>
                                <div class="ms-3 text-start">
                                    <div class="fw-semibold">Tambah User Baru</div>
                                    <div class="small text-muted">Buat Akun User Baru</div>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                        
                        <a href="{{ route('users.index') }}" class="btn btn-action btn-secondary-action">
                            <div class="d-flex align-items-center">
                                <div class="action-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </div>
                                <div class="ms-3 text-start">
                                    <div class="fw-semibold">Manajemen Semua User</div>
                                    <div class="small text-muted">Lihat dan Manajemen Semua User</div>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                        
                       
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Stats Cards */
.stats-card {
    border-radius: 16px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    border-color: #e5e7eb;
}

.stats-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-primary-soft {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    color: #667eea;
}

.bg-warning-soft {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.1) 100%);
    color: #f59e0b;
}

.bg-success-soft {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
    color: #10b981;
}

.bg-info-soft {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(29, 78, 216, 0.1) 100%);
    color: #3b82f6;
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

.user-avatar-small {
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

/* Role Badges */
.badge-role-admin {
    background: #fee2e2;
    color: #991b1b;
    padding: 0.35rem 0.75rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.badge-role-pm {
    background: #dbeafe;
    color: #1e40af;
    padding: 0.35rem 0.75rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.badge-role-member {
    background: #d1fae5;
    color: #065f46;
    padding: 0.35rem 0.75rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

/* Action Buttons */
.btn-action {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: left;
    transition: all 0.3s ease;
    color: #374151;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-decoration: none;
    color: #374151;
}

.btn-primary-action:hover {
    border-color: #667eea;
    background: #f8fafc;
}

.btn-secondary-action:hover {
    border-color: #6b7280;
    background: #f8fafc;
}

.btn-info-action:hover {
    border-color: #3b82f6;
    background: #f8fafc;
}

.btn-warning-action:hover {
    border-color: #f59e0b;
    background: #f8fafc;
}

.action-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
}

.btn-primary-action .action-icon {
    color: #667eea;
    background: rgba(102, 126, 234, 0.1);
}

.btn-secondary-action .action-icon {
    color: #6b7280;
    background: rgba(107, 114, 128, 0.1);
}

.btn-info-action .action-icon {
    color: #3b82f6;
    background: rgba(59, 130, 246, 0.1);
}

.btn-warning-action .action-icon {
    color: #f59e0b;
    background: rgba(245, 158, 11, 0.1);
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
}

/* Status Indicator */
.status-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

/* Responsive */
@media (max-width: 768px) {
    .stats-card .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .stats-icon {
        margin-top: 1rem;
        align-self: flex-end;
    }
    
    .table-modern thead th {
        font-size: 0.7rem;
        padding: 0.75rem 0.5rem;
    }
    
    .table-modern tbody td {
        padding: 1rem 0.5rem;
    }
    
    .user-avatar-small {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
}
</style>
@endsection