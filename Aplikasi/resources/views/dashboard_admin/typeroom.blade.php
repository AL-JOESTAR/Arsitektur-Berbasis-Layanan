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

            <h4 class="mb-0">
                Data Type Room
            </h4>

            <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#tambahTypeRoom">

                + Tambah Type Room

            </button>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark">

                <tr>

                    <th width="60">No</th>

                    <th>Nama Type Room</th>

                    <th>Harga / Bulan</th>

                    <th width="180">Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($typeRoom as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item['name'] }}
                        </td>

                        <td>

                            Rp {{ number_format($item['price'],0,',','.') }}

                        </td>

                        <td>

                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#edit{{ $item['id'] }}">

                                Edit

                            </button>

                            <form
                                action="/admin/type-room/{{ $item['id'] }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus Type Room ini?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            Belum ada data Type Room

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
    id="tambahTypeRoom"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                action="/admin/type-room"
                method="POST">

                @csrf

                <div class="modal-header">

                    <h5>

                        Tambah Type Room

                    </h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Type Room

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required>

                    </div>

                    <div>

                        <label class="form-label">

                            Harga / Bulan

                        </label>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            min="0"
                            required>

                    </div>

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
@foreach($typeRoom as $item)

<div
    class="modal fade"
    id="edit{{ $item['id'] }}"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                action="/admin/type-room/{{ $item['id'] }}"
                method="POST">

                @csrf

                @method('PUT')

                <div class="modal-header">

                    <h5>

                        Edit Type Room

                    </h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Type Room

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ $item['name'] }}"
                            required>

                    </div>

                    <div>

                        <label class="form-label">

                            Harga / Bulan

                        </label>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            value="{{ $item['price'] }}"
                            min="0"
                            required>

                    </div>

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