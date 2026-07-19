@extends('layouts_dashboard.master')


@section('konten')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Dashboard Admin</h2>
            <p class="text-muted mb-0">
                Selamat Datang, {{ Auth::user()->name }}
            </p>
        </div>
    </div>

    <div class="row">

        <!-- Total Kamar -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small mb-2">Total Kamar</h6>
                        <h2 class="mb-1">{{ $jumlahKamar }}</h2>
                        <small class="text-muted">Seluruh kamar yang tersedia</small>
                    </div>

                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width:58px;height:58px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 11l9-7 9 7M5 10v9a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1v-9"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total User -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small mb-2">Total Penyewa</h6>
                        <h2 class="mb-1">{{ $jumlahUser }}</h2>
                        <small class="text-muted">Jumlah akun pengguna</small>
                    </div>

                    <div class="rounded-3 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width:58px;height:58px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Laporan -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small mb-2">Total Laporan</h6>
                        <h2 class="mb-1">{{ $jumlahLaporan }}</h2>
                        <small class="text-muted">Laporan dari penyewa</small>
                    </div>

                    <div class="rounded-3 bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width:58px;height:58px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></svg>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-0">Informasi</h5>
            <hr>

            <p class="text-muted mb-0">
                Dashboard ini digunakan untuk mengelola data kamar,
                penyewa, laporan, serta proses administrasi pada sistem
                penyewaan kos berbasis Service Oriented Architecture (SOA).
            </p>

        </div>
    </div>

</div>

@endsection