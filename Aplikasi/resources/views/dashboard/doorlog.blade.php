@extends('layouts_dashboard.app')

@section('konten')

<div class="container">

    {{-- SCAN --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Door Access</h4>
        </div>

        <div class="card-body text-center">

            <button id="btnScan" class="btn btn-success mb-3">
                📷 Scan QR
            </button>

            <div id="reader" style="width:350px;margin:auto;"></div>

        </div>

    </div>


    {{-- QR CODE --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <h5>QR Door</h5>
        </div>

        <div class="card-body">

            <div class="row text-center">

                <div class="col-md-6">

                    <h4>QR MASUK</h4>

                    <img
                        width="220"
                        class="border rounded p-2"
                        src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=IN"
                    >

                </div>

                <div class="col-md-6">

                    <h4>QR KELUAR</h4>

                    <img
                        width="220"
                        class="border rounded p-2"
                        src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=OUT"
                    >

                </div>

            </div>

        </div>

    </div>


    {{-- RIWAYAT --}}
    <div class="card shadow-sm">

        <div class="card-header">
            <h5>Riwayat Door Access</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>

                <tr>

                    <th>Reader</th>
                    <th>Waktu Scan</th>
                    <th>Status</th>
                    <th>Reason</th>

                </tr>

                </thead>

                <tbody>

                @forelse($logs as $log)

                    <tr>


                        <td>{{ $log['reader']['reader_type'] }}</td>

                       <td>
    <div class="fw-semibold">
        {{ \Carbon\Carbon::parse($log['scan_time'])
            ->locale('id')
            ->translatedFormat('d M Y') }}
    </div>

    <small class="text-muted">
        {{ \Carbon\Carbon::parse($log['scan_time'])->format('H:i') }} WIB
    </small>
</td>

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

                        <td>{{ $log['reason'] }}</td>

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

@endsection


@section('script')

<script src="https://unpkg.com/html5-qrcode"></script>

<script>

const userId = @json(auth()->id());

document.getElementById('btnScan').onclick = function () {

    const html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: 250
        },
        function (decodedText) {

            html5QrCode.stop();

            fetch("/door/access", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    user_id: userId,
                    qr_code: decodedText
                })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                location.reload();
            });

        },
        function (error) {
            // ignore
        }
    );

};

</script>

@endsection