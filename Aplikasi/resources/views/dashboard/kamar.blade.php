@extends('layouts_dashboard.app')

@section('konten')

<div class="d-flex justify-content-between align-items-center flex-wrap mb-4 mt-3">
    <div>
        <h4 class="mb-1">Info Kamar</h4>
        <small class="text-muted">Ringkasan data kamar dan status sewa saat ini</small>
    </div>

    <span class="badge bg-primary px-3 py-2">
        {{ count($kamars) }} Kamar
    </span>
</div>

<div class="row">

@forelse ($kamars as $kamar)

    @php
        $status = $kamar['status_sewa'] ?? '-';
        $statusLower = strtolower($status);

        if($statusLower == 'aktif'){
            $statusClass = 'bg-success';
        }elseif($statusLower == 'pending'){
            $statusClass = 'bg-warning';
        }elseif($statusLower == 'selesai'){
            $statusClass = 'bg-secondary';
        }else{
            $statusClass = 'bg-danger';
        }
    @endphp

    <div class="col-md-6 col-lg-4 mb-4">

        <div class="card shadow h-100">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Kamar {{ $kamar['kamar']['Nomor_Kamar'] }}
                </h5>

                <span class="badge {{ $statusClass }}">
                    {{ $status }}
                </span>

            </div>

            <div class="card-body">

                <div class="mb-3">
                    <small class="text-muted">Tipe Kamar</small><br>

                    <strong>
                        {{ $kamar['kamar']['type_room']['name'] }}
                    </strong>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Harga / Bulan</small><br>

                    <strong>
                        Rp {{ number_format($kamar['kamar']['type_room']['price']) }}
                    </strong>
                </div>

                <hr>

                <div class="row text-center">

                    <div class="col-6">

                        <small class="text-muted d-block">
                            Mulai
                        </small>

                        <strong>
                            {{ \Carbon\Carbon::parse($kamar['start'])->format('d-m-Y') }}
                        </strong>

                    </div>

                    <div class="col-6">

                        <small class="text-muted d-block">
                            Berakhir
                        </small>

                        <strong>
                            {{ \Carbon\Carbon::parse($kamar['end'])->format('d-m-Y') }}
                        </strong>

                    </div>

                </div>

            </div>

            <div class="card-footer bg-white">

                @if(strtolower($kamar['status_sewa']) == 'aktif')

                    <a href="{{ route('perpanjang.index',$kamar['id']) }}"
                       class="btn btn-warning w-100">

                        Perpanjang Sewa

                    </a>

                @endif

            </div>

        </div>

    </div>

@empty

    <div class="col-12">

        <div class="alert alert-info">

            Anda belum memiliki kamar.

        </div>

    </div>

@endforelse

</div>

@endsection