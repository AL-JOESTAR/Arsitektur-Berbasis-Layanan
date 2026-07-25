@extends('layouts_dashboard.master')

@section('konten')

<div class="container">

    <div class="card mb-4">

        <div class="card-header">
            <h4>Status Pembayaran Penghuni</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Kamar</th>
                        <th>Nama Penyewa</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($penyewaan as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item['kamar']['Nomor_Kamar'] ?? '-' }}</td>

                        <td>{{ $item['nama_penyewa'] ?? '-' }}</td>

                        <td>
                            <span class="badge bg-{{ $item['warna'] }}">
                                {{ $item['status'] }}
                            </span>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            Tidak ada data
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <div class="card">

        <div class="card-header">
            <h4>Riwayat Pembayaran</h4>
        </div>

        <div class="card-body">

            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penyewa</th>
                        <th>Kamar</th>
                        <th>Nominal</th>
                        <th>Tanggal Bayar</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($riwayat as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item['nama_penyewa'] ?? '-' }}</td>

                        <td>
                            {{ $item['penyewaan']['kamar']['Nomor_Kamar'] ?? '-' }}
                        </td>

                        <td>
                            Rp {{ number_format($item['nominal'],0,',','.') }}
                        </td>

                        <td>
                            {{ $item['tanggal_bayar'] ?? '-' }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada riwayat pembayaran
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection