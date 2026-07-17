@extends('layouts_dashboard.app')

@section('konten')

<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <div>
        <h3 class="mb-1">Data Parent</h3>
        <p class="text-muted mb-0">Kelola data parent/wali di sini.</p>
    </div>
</div>

{{-- Form Tambah / Edit --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        @if(isset($parent))
            <h5 class="mb-0">Edit Parent</h5>
        @else
            <h5 class="mb-0">Tambah Parent</h5>
        @endif
    </div>

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($parent))

            <form action="{{ route('parents.update', $parent->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $parent->nama) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $parent->email) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $parent->no_hp) }}">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                    <a href="{{ route('parents.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>

        @else

            <form action="{{ route('parents.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>

        @endif

    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Parent</h5>
        <span class="badge bg-primary">{{ count($parents) }} Data</span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th class="text-center pe-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($parents as $item)
                    <tr>
                        <td class="ps-3">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>

                        <td class="text-center pe-3">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('parents.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <form action="{{ route('parents.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada data.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection