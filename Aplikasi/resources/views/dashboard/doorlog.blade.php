@extends('layouts_dashboard.app')

@section('konten')
<div class="container">

    <div class="row">

        {{-- CARD SCAN --}}
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Door Access</h4>
                </div>

                <div class="card-body">

                    <div class="text-center">

                        <button class="btn btn-success mb-3" id="btnScan">
                            📷 Scan QR
                        </button>

                        <div id="reader" style="width:350px; margin:auto;"></div>

                    </div>

                </div>

            </div>
        </div>

        {{-- QR READER --}}
        <div class="col-md-12 mb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h5>QR Reader</h5>
                </div>

                <div class="card-body">

                    <div class="row">

                        @foreach($readers as $reader)

                            <div class="col-md-6 text-center mb-4">

                                <h5>{{ ucfirst($reader->reader_name) }}</h5>

                                <p>
                                    {{ $reader->reader_type }}
                                </p>

                                <img
                                    class="img-fluid border rounded p-2"
                                    width="220"
                                    src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode(route('door.scan', $reader->id)) }}"
                                    alt="QR">

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

        {{-- RIWAYAT --}}
        <div class="col-md-12">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h5>Riwayat Door Access</h5>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Reader</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Reason</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($logs as $log)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

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

                                <td>{{ $log->reason }}</td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada riwayat.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@section('script')

<script src="https://unpkg.com/html5-qrcode"></script>

<script>

document.getElementById('btnScan').addEventListener('click', function () {

    let html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: 250
        },
        function(decodedText){

            // QR berisi URL
            window.location.href = decodedText;

        },
        function(error){
            // abaikan error scan
        }
    );

});

</script>

@endsection