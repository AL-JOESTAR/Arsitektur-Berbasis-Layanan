@extends('layouts_dashboard.master')

@section('konten')

<div class="container mt-3">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3>Type Room</h3>
            <p class="text-muted mb-0">
                Kelola data tipe kamar yang tersedia.
            </p>
        </div>

        <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#tambahModal">

            + Tambah Type Room

        </button>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">
                Daftar Type Room
            </h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="60">No</th>
                        <th>Type Room</th>
                        <th width="180">Harga</th>
                        <th width="320">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($typeRooms as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            <strong>{{ $item['name'] }}</strong>

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
                                action="{{ route('typeroom.destroy',$item['id']) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data ini?')">

                                    Delete

                                </button>

                            </form>

                            <a
                                href="{{ route('typeroom.facility',$item['id']) }}"
                                class="btn btn-success btn-sm">

                                Kelola Fasilitas

                            </a>

                        </td>

                    </tr>


                    {{-- Modal Edit --}}

                    <div
                        class="modal fade"
                        id="edit{{ $item['id'] }}"
                        tabindex="-1">

                        <div class="modal-dialog">

                            <form
                                action="{{ route('typeroom.update',$item['id']) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5>Edit Type Room</h5>

                                        <button
                                            type="button"
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
                                                class="form-control"
                                                name="name"
                                                value="{{ $item['name'] }}"
                                                required>

                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label">

                                                Harga

                                            </label>

                                            <input
                                                type="number"
                                                class="form-control"
                                                name="price"
                                                value="{{ $item['price'] }}"
                                                required>

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal">

                                            Batal

                                        </button>

                                        <button
                                            class="btn btn-warning">

                                            Update

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            Belum ada data Type Room.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



{{-- Modal Tambah --}}

<div
    class="modal fade"
    id="tambahModal"
    tabindex="-1">

    <div class="modal-dialog">

        <form
            action="{{ route('typeroom.store') }}"
            method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header">

                    <h5>Tambah Type Room</h5>

                    <button
                        type="button"
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
                            class="form-control"
                            name="name"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Harga

                        </label>

                        <input
                            type="number"
                            class="form-control"
                            name="price"
                            required>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection