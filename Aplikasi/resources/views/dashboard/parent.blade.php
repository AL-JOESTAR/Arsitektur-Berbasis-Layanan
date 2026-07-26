@extends('layouts_dashboard.app')

@section('konten')

<div class="container py-3">

    <div class="mb-4">

        <h3 class="fw-bold">
            <i class="bi bi-people-fill text-primary"></i>
            Data Parent / Wali
        </h3>

        <p class="text-muted mb-0">
            Data ini digunakan agar orang tua/wali dapat memantau aktivitas keluar masuk penghuni kos.
        </p>

    </div>

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

            <button class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    @endif


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                @if($parent)

                    <i class="bi bi-pencil-square"></i>
                    Edit Data Parent

                @else

                    <i class="bi bi-person-plus-fill"></i>
                    Tambah Data Parent

                @endif

            </h5>

        </div>

        <div class="card-body">

            @if($parent)

                <form action="{{ route('parents.update',$parent->id) }}" method="POST">

                @csrf
                @method('PUT')

            @else

                <form action="{{ route('parents.store') }}" method="POST">

                @csrf

            @endif

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Nama Parent

                    </label>

                    <input

                        type="text"

                        name="nama"

                        class="form-control"

                        placeholder="Masukkan nama"

                        value="{{ old('nama',$parent->nama ?? '') }}"

                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Email

                    </label>

                    <input

                        type="email"

                        name="email"

                        class="form-control"

                        placeholder="email@example.com"

                        value="{{ old('email',$parent->email ?? '') }}"

                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Nomor HP

                    </label>

                    <input

                        type="text"

                        name="no_hp"

                        class="form-control"

                        placeholder="08xxxxxxxxxx"

                        value="{{ old('no_hp',$parent->no_hp ?? '') }}"

                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Password Login Parent

                    </label>

                    <div class="input-group">

                        <input

                            type="password"

                            id="password"

                            name="password"

                            class="form-control"

                            placeholder="{{ $parent ? 'Kosongkan jika tidak diubah' : 'Masukkan password' }}"

                            {{ $parent ? '' : 'required' }}>

                        <button

                            class="btn btn-outline-secondary"

                            type="button"

                            onclick="togglePassword()">

                            <i class="bi bi-eye" id="iconPassword"></i>

                        </button>

                    </div>

                    @if($parent)

                        <small class="text-muted">

                            Kosongkan jika tidak ingin mengganti password.

                        </small>

                    @endif

                </div>

            </div>

            <div class="mt-3">

                @if($parent)

                    <button class="btn btn-warning">

                        <i class="bi bi-pencil-square"></i>

                        Update Data

                    </button>

                @else

                    <button class="btn btn-primary">

                        <i class="bi bi-save"></i>

                        Simpan Data

                    </button>

                @endif

            </div>

            </form>

        </div>

    </div>


    @if($parent)

    <div class="card shadow-sm border-0 mt-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                <i class="bi bi-person-vcard-fill"></i>

                Informasi Parent

            </h5>

        </div>

        <div class="card-body">

            <table class="table table-borderless align-middle">

                <tr>

                    <th width="180">

                        <i class="bi bi-person"></i>
                        Nama

                    </th>

                    <td>{{ $parent->nama }}</td>

                </tr>

                <tr>

                    <th>

                        <i class="bi bi-envelope"></i>
                        Email

                    </th>

                    <td>{{ $parent->email }}</td>

                </tr>

                <tr>

                    <th>

                        <i class="bi bi-telephone"></i>
                        Nomor HP

                    </th>

                    <td>{{ $parent->no_hp }}</td>

                </tr>

            </table>

            <hr>

            <form
                action="{{ route('parents.destroy',$parent->id) }}"
                method="POST"
                onsubmit="return confirm('Hapus data parent?')">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger">

                    <i class="bi bi-trash"></i>

                    Hapus Data Parent

                </button>

            </form>

        </div>

    </div>

    @endif

</div>

@endsection


@section('script')

<script>

function togglePassword(){

    let password = document.getElementById("password");

    let icon = document.getElementById("iconPassword");

    if(password.type==="password"){

        password.type="text";

        icon.classList.remove("bi-eye");

        icon.classList.add("bi-eye-slash");

    }else{

        password.type="password";

        icon.classList.remove("bi-eye-slash");

        icon.classList.add("bi-eye");

    }

}

</script>

@endsection