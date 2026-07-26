@extends('layouts_dashboard.master')

@section('konten')

<div class="d-flex align-items-start gap-3 mb-4">
    <div class="bg-warning bg-opacity-25 text-warning-emphasis rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:52px;height:52px;">
        <i class="bi bi-building-gear fs-4"></i>
    </div>
    <div>
        <h3 class="fw-bold mb-1">Data Facility</h3>
        <p class="text-muted mb-0">
            Kelola daftar fasilitas yang tersedia di kos.
        </p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i>
        <div>{{ session('success') }}</div>
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center gap-2">
            <div class="bg-warning bg-opacity-25 text-warning-emphasis rounded-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width:34px;height:34px;">
                <i class="bi bi-list-check"></i>
            </div>
            <h5 class="mb-0 fw-bold">Daftar Facility</h5>
        </div>

        <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#tambahFacility">

            <i class="bi bi-plus-lg me-1"></i>
            Tambah Facility

        </button>

    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead>

                <tr>

                    <th width="60">No</th>

                    <th>Nama Facility</th>

                    <th width="180">Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($facility as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item['name'] }}</td>

                        <td>

                            <button
                                class="btn btn-outline-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#edit{{ $item['id'] }}">

                                <i class="bi bi-pencil-square"></i>
                                Edit

                            </button>

                            <form
                                action="/admin/facility/{{ $item['id'] }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button
                                    class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Hapus facility ini?')">

                                    <i class="bi bi-trash"></i>
                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                            Belum ada data Facility
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>


{{-- MODAL TAMBAH --}}
<div
    class="modal fade"
    id="tambahFacility"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content border-0 shadow">

            <form
                action="/admin/facility"
                method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-plus-circle-fill text-warning me-1"></i>
                        Tambah Facility
                    </h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <label class="form-label fw-semibold">

                        Nama Facility

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required>

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        class="btn btn-primary">

                        <i class="bi bi-save me-1"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- MODAL EDIT --}}
@foreach($facility as $item)

<div
    class="modal fade"
    id="edit{{ $item['id'] }}"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content border-0 shadow">

            <form
                action="/admin/facility/{{ $item['id'] }}"
                method="POST">

                @csrf

                @method('PUT')

                <div class="modal-header">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-pencil-square text-warning me-1"></i>
                        Edit Facility
                    </h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <label class="form-label fw-semibold">

                        Nama Facility

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $item['name'] }}"
                        required>

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        class="btn btn-warning">

                        <i class="bi bi-pencil-square me-1"></i>
                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endforeach

@endsection