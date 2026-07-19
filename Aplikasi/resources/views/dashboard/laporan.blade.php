@extends('layouts_dashboard.app')

@section('konten')

<div class="container-fluid mt-4">

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

            <div class="card shadow-sm border-0">
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

    <div class="row justify-content-center mt-5">
        <div class="col-lg-10">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Riwayat Laporan</h4>
                @if(count($laporans))
                    <span class="badge bg-secondary">{{ count($laporans) }} Laporan</span>
                @endif
            </div>

            @if(count($laporans))

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">No</th>
                                    <th>Kamar</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th class="pe-3">Tanggal</th>
                                </tr>
                            </thead>

                            <tbody>

                            @foreach($laporans as $laporan)

                                <tr>

                                    <td class="ps-3">{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $laporan['penyewaan']['kamar']['Nomor_Kamar'] }}
                                    </td>

                                    <td>{{ $laporan['deskripsi'] }}</td>

                                    <td>

                            @if($laporan['status_laporan'] == 'menunggu')

                                <span class="badge bg-warning text-dark">
                                    Menunggu
                                </span>

                            @elseif($laporan['status_laporan'] == 'diproses')

                                <span class="badge bg-primary">
                                    Diproses
                                </span>

                            @elseif($laporan['status_laporan'] == 'selesai')

                                <span class="badge bg-success">
                                    Selesai
                                </span>

                            @endif

                        </td>

                                    <td class="pe-3">
                                        {{ \Carbon\Carbon::parse($laporan['created_at'])->format('d-m-Y H:i') }}
                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            @else

            <div class="alert alert-info mb-0">
                Belum ada laporan.
            </div>

            @endif

        </div>
    </div>

</div>
@endsection