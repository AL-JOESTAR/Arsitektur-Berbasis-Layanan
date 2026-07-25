@extends('layouts_dashboard.master')

@section('konten')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">
                Riwayat Door Access
            </h4>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>Nama</th>
                        <th>Reader</th>
                        <th>Waktu Scan</th>
                        <th>Status</th>
                        <th>Reason</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($logs as $log)

                    <tr>
                        <td>{{ $log['nama_user'] }}</td>

                        <td>{{ $log['reader']['reader_name'] }}</td>

                        <td>{{ $log['scan_time'] }}</td>

                        <td>

                            @if($log['access_result']=="allow")

                                <span class="badge bg-success">
                                    Allow
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Deny
                                </span>

                            @endif

                        </td>

                        <td>{{ ucfirst($log['reason']) }}</td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Belum ada riwayat.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection