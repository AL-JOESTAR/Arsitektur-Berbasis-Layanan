@extends('layouts_dashboard.master')

@section('konten')

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">Data Facility</h4>

            <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#tambahFacility">

                + Tambah Facility

            </button>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

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
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#edit{{ $item['id'] }}">

                                Edit

                            </button>

                            <form
                                action="/admin/facility/{{ $item['id'] }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus facility ini?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3" class="text-center">

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

        <div class="modal-content">

            <form
                action="/admin/facility"
                method="POST">

                @csrf

                <div class="modal-header">

                    <h5>Tambah Facility</h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <label class="form-label">

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

        <div class="modal-content">

            <form
                action="/admin/facility/{{ $item['id'] }}"
                method="POST">

                @csrf

                @method('PUT')

                <div class="modal-header">

                    <h5>Edit Facility</h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <label class="form-label">

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

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endforeach

@endsection