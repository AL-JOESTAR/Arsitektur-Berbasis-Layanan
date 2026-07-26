@extends('layouts_dashboard.master')

@section('konten')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Kelola Fasilitas Type Room</h3>
            <p class="text-muted mb-0">
                Pilih fasilitas yang dimiliki oleh type room ini.
            </p>
        </div>

        <a href="{{ url('/admin/type-room') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                Informasi Type Room
            </h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="200">Nama Type Room</th>
                    <td>{{ $typeRoom['name'] }}</td>
                </tr>

                <tr>
                    <th>Harga</th>
                    <td>
                        Rp {{ number_format($typeRoom['price'],0,',','.') }}
                    </td>
                </tr>

            </table>

        </div>

    </div>


    <div class="card shadow-sm mt-4">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                Daftar Fasilitas
            </h5>
        </div>

        <div class="card-body">

            <form action="{{ route('typeroom.facility.save',$typeRoom['id']) }}" method="POST">

                @csrf

                @php
                    $selected = collect($typeRoom['facilities'] ?? [])
                                    ->pluck('id')
                                    ->toArray();
                @endphp

                <div class="row">

                    @foreach($facilities as $facility)

                        <div class="col-md-4 mb-3">

                            <div class="form-check border rounded p-3">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="facilities[]"
                                    value="{{ $facility['id'] }}"
                                    id="facility{{ $facility['id'] }}"
                                    {{ in_array($facility['id'],$selected) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="facility{{ $facility['id'] }}"
                                >
                                    {{ $facility['name'] }}
                                </label>

                            </div>

                        </div>

                    @endforeach

                </div>

                <button class="btn btn-primary mt-3">
                    Simpan Fasilitas
                </button>

            </form>

        </div>

    </div>

</div>

@endsection