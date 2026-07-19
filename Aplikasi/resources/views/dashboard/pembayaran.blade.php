@extends('layouts_dashboard.app')

@section('konten')

<h3 class="mb-4">Riwayat Pembayaran</h3>

<div class="card shadow-sm">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Kamar</th>
                    <th>Jenis</th>
                    <th>Periode</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Tanggal Bayar</th>
                </tr>

            </thead>

            <tbody>

                @forelse($pembayarans as $i => $item)

                <tr>

                    <td>{{ $i+1 }}</td>

                    <td>
                        {{ $item['penyewaan']['kamar']['Nomor_Kamar'] }}
                    </td>

                    <td>
                        {{ ucfirst($item['jenis_pembayaran']) }}
                    </td>

                    <td>
                        {{ $item['periode'] }} Bulan
                    </td>

                    <td>
                        Rp {{ number_format($item['nominal']) }}
                    </td>

                    <td>

                        @if($item['status_bayar']=='paid')

                            <span class="badge bg-success">
                                Lunas
                            </span>

                        @elseif($item['status_bayar']=='pending')

                            <span class="badge bg-warning">
                                Pending
                            </span>

                        @else

                            <span class="badge bg-danger">
                                {{ ucfirst($item['status_bayar']) }}
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $item['tanggal_bayar'] ?? '-' }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center">
                        Belum ada riwayat pembayaran.
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection