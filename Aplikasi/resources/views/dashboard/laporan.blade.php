@extends('layouts_dashboard.app')

@section('konten')

<div class="container mt-4">

                <h3>Buat Laporan</h3>

                @if(session('success'))

                <div class="alert alert-success">

                {{ session('success') }}

                </div>

                @endif

                @if(session('error'))

                <div class="alert alert-danger">

                {{ session('error') }}

                </div>

                @endif

                <form method="POST" action="/laporan">

                @csrf

                <div class="mb-3">

                <label>Pilih Kamar</label>

                <select name="penyewaan_id" class="form-control">

                    <option value="{{ $penyewaan['id'] }}">
                        Kamar {{ $penyewaan['kamar']['Nomor_Kamar'] }}
                    </option>

                </select>

                </div>

                <div class="mb-3">

                <label>Deskripsi</label>

                <textarea

                name="deskripsi"

                class="form-control"

                rows="5"

                required

                ></textarea>

                </div>

                <button class="btn btn-primary">

                Kirim Laporan

                </button>

                </form>

                </div>



                </div>
            </div>
@endsection