@extends('layouts_dashboard.master')


@section('konten')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h3 class="mb-3">Kelola Kamar</h3>

    <!-- FORM TAMBAH -->
    <div class="card mb-4">
        <div class="card-header">
            Tambah Kamar
        </div>

        <div class="card-body">

            <form action="/admin/kamar" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nomor Kamar</label>
                    <input type="text"
                           name="Nomor_Kamar"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Type Room</label>

                    <select name="type_room_id"
                            class="form-control">

                        <option value="1">Type Room 1</option>
                        <option value="2">Type Room 2</option>
                        <option value="3">Type Room 3</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status_kamar"
                            class="form-control">

                        <option value="Tersedia">Tersedia</option>
                        <option value="Reserved">Reserved</option>
                        <option value="Aktif">Aktif</option>

                    </select>
                </div>

                <button class="btn btn-primary">
                    Tambah
                </button>

            </form>

        </div>
    </div>

    <!-- TABEL -->
    <table class="table table-bordered">

        <thead>

        <tr>
            <th>No</th>
            <th>Nomor</th>
            <th>Type</th>
            <th>Status</th>
            <th width="250">Aksi</th>
        </tr>

        </thead>

        <tbody>

        @foreach($kamars as $kamar)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $kamar['Nomor_Kamar'] }}</td>

            <td>Type {{ $kamar['type_room_id'] }}</td>

            <td>{{ $kamar['status_kamar'] }}</td>

            <td>

                <!-- Modal Edit -->
                <button
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#edit{{ $kamar['id'] }}">
                    Edit
                </button>

                <form
                    action="/admin/kamar/{{ $kamar['id'] }}"
                    method="POST"
                    style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin?')">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

        <!-- Modal -->
        <div class="modal fade" id="edit{{ $kamar['id'] }}">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form action="/admin/kamar/{{ $kamar['id'] }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5>Edit Kamar</h5>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Nomor</label>

                                <input
                                    type="text"
                                    name="Nomor_Kamar"
                                    class="form-control"
                                    value="{{ $kamar['Nomor_Kamar'] }}">
                            </div>

                            <div class="mb-3">
                                <label>Type Room</label>

                                <select
                                    name="type_room_id"
                                    class="form-control">

                                    <option value="1"
                                        {{ $kamar['type_room_id']==1?'selected':'' }}>
                                        Type Room 1
                                    </option>

                                    <option value="2"
                                        {{ $kamar['type_room_id']==2?'selected':'' }}>
                                        Type Room 2
                                    </option>

                                    <option value="3"
                                        {{ $kamar['type_room_id']==3?'selected':'' }}>
                                        Type Room 3
                                    </option>

                                </select>
                            </div>

                            <div class="mb-3">

                                <label>Status</label>

                                <select
                                    name="status_kamar"
                                    class="form-control">

                                    <option value="Tersedia"
                                        {{ $kamar['status_kamar']=='Tersedia'?'selected':'' }}>
                                        Tersedia
                                    </option>

                                    <option value="Reserved"
                                        {{ $kamar['status_kamar']=='Reserved'?'selected':'' }}>
                                        Reserved
                                    </option>

                                    <option value="Aktif"
                                        {{ $kamar['status_kamar']=='Aktif'?'selected':'' }}>
                                        Aktif
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button
                                class="btn btn-primary">
                                Simpan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

        </tbody>

    </table>

</div>

@endsection