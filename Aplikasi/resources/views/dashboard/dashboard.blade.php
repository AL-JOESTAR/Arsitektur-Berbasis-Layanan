@extends('layouts_dashboard.app')

@section('konten')

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4 d-flex flex-wrap align-items-center gap-4">
        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fs-3 fw-bold flex-shrink-0"
             style="width:72px;height:72px;">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="flex-grow-1">
            <h4 class="mb-1">{{ $user->name }}</h4>
            <div class="text-muted small">{{ $user->email }}</div>
            <div class="mt-2 d-flex gap-2 flex-wrap">
                <span class="badge bg-info">{{ ucfirst($user->role) }}</span>
                @if($user->status_user == 'active')
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                Edit Profil
            </a>

            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="btn btn-outline-danger">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
</div>

<div class="row mb-4 g-3">

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width:46px;height:46px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small mb-1">Nama</h6>
                    <h5 class="mb-0">{{ $user->name }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width:46px;height:46px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small mb-1">Status</h6>
                    <h5 class="mb-0">{{ ucfirst($user->status_user) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 bg-warning bg-opacity-25 text-warning-emphasis d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width:46px;height:46px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2l3 6 6 .9-4.5 4.3 1 6.1L12 16.9 6.5 19.3l1-6.1L3 8.9 9 8l3-6z"/></svg>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small mb-1">Role</h6>
                    <h5 class="mb-0">{{ ucfirst($user->role) }}</h5>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Profil Saya</h5>
        <small class="text-muted">Detail informasi akun Anda</small>
    </div>

    <div class="card-body">

        <div class="row py-3 border-bottom">
            <div class="col-md-3 fw-bold text-secondary">Nama</div>
            <div class="col-md-9">{{ $user->name }}</div>
        </div>

        <div class="row py-3 border-bottom">
            <div class="col-md-3 fw-bold text-secondary">Email</div>
            <div class="col-md-9">{{ $user->email }}</div>
        </div>

        <div class="row py-3 border-bottom">
            <div class="col-md-3 fw-bold text-secondary">No HP</div>
            <div class="col-md-9">{{ $user->no_hp ?? '-' }}</div>
        </div>

        <div class="row py-3 border-bottom">
            <div class="col-md-3 fw-bold text-secondary">Role</div>
            <div class="col-md-9">
                <span class="badge bg-info">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
        </div>

        <div class="row py-3 border-bottom">
            <div class="col-md-3 fw-bold text-secondary">Status</div>
            <div class="col-md-9">

                @if($user->status_user == 'active')
                    <span class="badge bg-success">
                        Active
                    </span>
                @else
                    <span class="badge bg-danger">
                        Nonaktif
                    </span>
                @endif

            </div>
        </div>

        <div class="row py-3 border-bottom">
            <div class="col-md-3 fw-bold text-secondary">Parent ID</div>
            <div class="col-md-9">{{ $user->parent_id ?? '-' }}</div>
        </div>

        <div class="row py-3">
            <div class="col-md-3 fw-bold text-secondary">Bergabung</div>
            <div class="col-md-9">{{ $user->created_at->format('d M Y') }}</div>
        </div>

    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
        Edit Profil
    </a>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form-bottom').submit();"
       class="btn btn-danger">
        Logout
    </a>

    <form id="logout-form-bottom" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
</div>

@endsection