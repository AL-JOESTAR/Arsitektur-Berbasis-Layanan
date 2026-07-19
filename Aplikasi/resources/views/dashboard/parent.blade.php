@extends('layouts_dashboard.app')

@section('konten')

<div class="container mt-3">

    <div class="mb-4">
        <h3>Data Parent</h3>
        <p class="text-muted">
            Lengkapi data orang tua / wali.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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


    <div class="card shadow-sm">

        <div class="card-header">

            @if($parent)

                <h5 class="mb-0">
                    Edit Data Parent
                </h5>

            @else

                <h5 class="mb-0">
                    Tambah Data Parent
                </h5>

            @endif

        </div>

        <div class="card-body">

            @if($parent)

                <form action="{{ route('parents.update', $parent->id) }}" method="POST">

                    @csrf
                    @method('PUT')

            @else

                <form action="{{ route('parents.store') }}" method="POST">

                    @csrf

            @endif


                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="{{ old('nama', $parent->nama ?? '') }}"
                            required>

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $parent->email ?? '') }}"
                            required>

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            No HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            class="form-control"
                            value="{{ old('no_hp', $parent->no_hp ?? '') }}"
                            required>

                    </div>

                </div>


                @if($parent)

                    <button class="btn btn-warning">
                        Update Data Parent
                    </button>

                @else

                    <button class="btn btn-primary">
                        Simpan Data Parent
                    </button>

                @endif

            </form>

        </div>

    </div>


    @if($parent)

    <div class="card shadow-sm mt-4">

        <div class="card-header">

            <h5 class="mb-0">
                Informasi Parent
            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="200">
                        Nama
                    </th>

                    <td>
                        {{ $parent->nama }}
                    </td>
                </tr>

                <tr>

                    <th>
                        Email
                    </th>

                    <td>
                        {{ $parent->email }}
                    </td>

                </tr>

                <tr>

                    <th>
                        No HP
                    </th>

                    <td>
                        {{ $parent->no_hp }}
                    </td>

                </tr>

            </table>

        </div>

    </div>

    @endif

</div>

@endsection