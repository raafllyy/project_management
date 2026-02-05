@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Proyek</h2>
            <p class="text-muted mb-0">Manajemen dan pengorganisasian semua proyek Anda</p>
        </div>

        {{-- HANYA PM YANG BISA LIHAT TOMBOL BUAT --}}
        @role('Project Manager')
        <a href="{{ route('projects.create') }}"
           class="btn btn-primary btn-create d-flex align-items-center gap-2 px-4 py-2">

            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                 fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 5v14M5 12h14"></path>
            </svg>

            <span class="fw-semibold">Buat Proyek</span>
        </a>
        @endrole
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-modern d-flex align-items-center mb-4">
            {{ session('success') }}
        </div>
    @endif


    @if($projects->count())

    <div class="row g-4">

        @foreach($projects as $project)

        <div class="col-lg-6 col-xl-4">

            <div class="card project-card h-100 border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 pb-3">

                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <div class="project-icon">
                            📁
                        </div>

                        {{-- STATUS BADGE --}}
                        @if($project->status === 'Pending')
                            <span class="badge badge-pending">Pending</span>

                        @elseif($project->status === 'Active')
                            <span class="badge badge-active">Active</span>

                        @else
                            <span class="badge badge-complete">Completed</span>
                        @endif

                    </div>

                    <h5 class="card-title fw-bold text-dark mb-0">
                        {{ $project->name }}
                    </h5>

                </div>


                <div class="card-body pt-0">

                    {{-- Deadline --}}
                    <div class="text-muted mb-3">
                        <small>
                            Deadline :
                            {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
                        </small>
                    </div>

                    {{-- Members --}}
                    <div class="mb-3">
                        <small class="text-muted fw-semibold d-block mb-2">
                            Anggota Tim
                        </small>

                        <div class="d-flex flex-wrap gap-2">

                            @forelse($project->members as $member)
                                <span class="badge badge-member">
                                    {{ $member->name }}
                                </span>
                            @empty
                                <span class="text-muted small">
                                    Tidak ada anggota
                                </span>
                            @endforelse

                        </div>
                    </div>

                </div>


                <div class="card-footer bg-white border-0 pt-0 pb-4">

                    <div class="d-flex gap-2">

                        <a href="{{ route('projects.show',$project) }}"
                           class="btn btn-outline-primary btn-action flex-fill">
                            Detail
                        </a>

                        {{-- HANYA PM YANG BISA LIHAT TOMBOL EDIT & DELETE --}}
                        @role('Project Manager')
                        <a href="{{ route('projects.edit',$project) }}"
                           class="btn btn-outline-warning btn-action flex-fill">
                            Edit
                        </a>

                        <form action="{{ route('projects.destroy',$project) }}"
                              method="POST"
                              class="flex-fill">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Yakin hapus project?')"
                                    class="btn btn-outline-danger btn-action w-100">
                                Delete
                            </button>
                        </form>
                        @endrole

                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    @else

    <div class="empty-state text-center py-5">
        <h4 class="fw-bold">Belum ada proyek</h4>
        <p class="text-muted">Mulai dengan membuat proyek pertama</p>

        {{-- TOMBOL EMPTY STATE HANYA UNTUK PM --}}
        @role('Project Manager')
        <a href="{{ route('projects.create') }}"
           class="btn btn-primary px-4 py-2">
            Buat Project
        </a>
        @endrole
    </div>

    @endif

</div>


<style>

/* ===== CARD ===== */
.project-card{
    border-radius:16px;
    transition:0.3s;
}

.project-card:hover{
    transform:translateY(-4px);
}

/* ===== ICON ===== */
.project-icon{
    width:45px;
    height:45px;
    background:linear-gradient(135deg,#667eea,#764ba2);
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:20px;
}

/* ===== STATUS BADGE DASHBOARD STYLE ===== */

.badge{
    font-size:0.75rem;
    font-weight:700;
    padding:6px 14px;
    border-radius:999px;
}

/* Pending = Biru */
.badge-pending{
    background:#dbeafe;
    color:#1d4ed8;
}

/* Active = Merah */
.badge-active{
    background:#fee2e2;
    color:#b91c1c;
}

/* Complete = Hijau */
.badge-complete{
    background:#dcfce7;
    color:#166534;
}

/* Member */
.badge-member{
    background:#f3f4f6;
    color:#374151;
    font-weight:500;
    border-radius:999px;
}

/* Button */
.btn-create{
    background:linear-gradient(135deg,#667eea,#764ba2);
    border:none;
    border-radius:12px;
}

.btn-action{
    border-radius:10px;
}

/* Empty */
.empty-state{
    border:2px dashed #e5e7eb;
    border-radius:16px;
}

</style>

@endsection