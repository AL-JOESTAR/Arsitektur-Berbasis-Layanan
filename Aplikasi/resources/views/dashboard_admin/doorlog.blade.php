@extends('layouts_dashboard.master')

@section('konten')

<div class="container-fluid">

    <div class="row">

        {{-- QR Reader --}}
        <div class="col-md-12 mb-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">QR Door Access</h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        @foreach($readers as $reader)

                        <div class="col-md-6 text-center mb-4">

                            <div class="card">

                                <div class="card-body">

                                    <h4>{{ ucfirst($reader->reader_name) }}</h4>

                                    <span class="badge bg-info">
                                        {{ $reader->reader_type }}
                                    </span>

                                    <br><br>

                                    <img
                                        class="img-fluid border rounded"
                                        width="250"
                                        src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode(route('door.scan',$reader->id)) }}"
                                        alt="QR">

                                    <br><br>

                                </div>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

        {{-- Riwayat --}}
        <div class="col-md-12">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Riwayat Door Access</h4>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead class="table-dark">

                            <tr>

                                <th>User</th>
                                <th>Reader</th>
                                <th>Scan Time</th>
                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                        @forelse($logs as $log)

                        <tr>
                            <td>{{ $log->user->name }}</td>

                            <td>{{ $log->reader->reader_name }}</td>


                            <td>{{ $log->scan_time }}</td>

                            <td>

                                @if($log->access_result == 'allow')

                                    <span class="badge bg-success">
                                        Allow
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Deny
                                    </span>

                                @endif

                            </td>   

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">
                                Belum ada riwayat.
                            </td>

                        </tr>

                        @endforelse

                        </tbody>

                    </table>

                    <div class="mt-3">
                        {{ $logs->links() }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection