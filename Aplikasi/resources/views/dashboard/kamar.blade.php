@extends('layouts_dashboard.app')

@section('konten')

<div class="d-flex justify-content-between align-items-center flex-wrap mb-4 mt-3">
    <div>
        <h4 class="mb-1">Info Kamar</h4>
        <small class="text-muted">Ringkasan data kamar dan status sewa saat ini</small>
    </div>
    <span class="badge bg-primary px-3 py-2">{{ count($kamars) }} Kamar</span>
</div>

<div class="row">
    @forelse ($kamars as $kamar)
        @php
            $status = $kamar['status_sewa'] ?? '-';
            $statusLower = strtolower($status);

            if (in_array($statusLower, ['disewa', 'terisi', 'aktif'])) {
                $statusClass = 'bg-danger';
            } elseif (in_array($statusLower, ['kosong', 'tersedia', 'available'])) {
                $statusClass = 'bg-success';
            } else {
                $statusClass = 'bg-secondary';
            }
        @endphp

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Kamar {{ $kamar['kamar']['Nomor_Kamar'] }}</h5>
                    <span class="badge {{ $statusClass }}">{{ $status }}</span>
                </div>

                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <small class="text-muted d-block">Tipe Kamar</small>
                        <span class="fw-semibold">{{ $kamar['kamar']['type_room']['name'] }}</span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Harga</small>
                        <span class="fw-semibold">Rp {{ number_format($kamar['kamar']['type_room']['price']) }}</span>
                    </div>

                    <hr>

                    <div class="row text-center mt-auto">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block">Mulai</small>
                            <span class="fw-semibold">{{ $kamar['start'] }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Selesai</small>
                            <span class="fw-semibold">{{ $kamar['end'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">
                Belum ada data kamar untuk ditampilkan.
            </div>
        </div>
    @endforelse
</div>

@endsection