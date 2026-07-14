@extends('layouts_dashboard.app')

@section('konten')

<div class="container mt-4">

    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="mb-4">
                <h3 class="mb-1">Buat Laporan</h3>
                <p class="text-muted mb-0">Isi form di bawah untuk mengirim laporan terkait kamar sewaan.</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                {{ session('error') }}
            </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <form method="POST" action="/laporan">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Kamar</label>
                            <select name="penyewaan_id" class="form-select">
                                <option value="{{ $penyewaan['id'] }}">
                                    Kamar {{ $penyewaan['kamar']['Nomor_Kamar'] }}
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="5"
                                placeholder="Jelaskan detail laporan Anda di sini..."
                                required
                            ></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection