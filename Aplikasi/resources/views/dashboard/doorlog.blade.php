@extends('layouts_dashboard.app')

@section('konten')

<div class="d-flex align-items-start gap-3 mb-4">
    <div class="bg-warning bg-opacity-25 text-warning-emphasis rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:52px;height:52px;">
        <i class="bi bi-qr-code-scan fs-4"></i>
    </div>
    <div>
        <h3 class="fw-bold mb-1">Door Access</h3>
        <p class="text-muted mb-0">
            Scan QR untuk mencatat akses keluar masuk penghuni kos.
        </p>
    </div>
</div>

{{-- SCAN --}}
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white d-flex align-items-center gap-2">
        <div class="bg-warning bg-opacity-25 text-warning-emphasis rounded-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width:34px;height:34px;">
            <i class="bi bi-camera-fill"></i>
        </div>
        <h5 class="mb-0 fw-bold">Scan QR Akses Pintu</h5>
    </div>

    <div class="card-body text-center">

        <button id="btnScan" class="btn btn-primary mb-3">
            <i class="bi bi-qr-code-scan me-1"></i>
            Scan QR
        </button>

        <div id="reader" style="width:350px;margin:auto;"></div>

    </div>

</div>


{{-- QR CODE --}}
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white d-flex align-items-center gap-2">
        <div class="bg-success bg-opacity-25 text-success-emphasis rounded-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width:34px;height:34px;">
            <i class="bi bi-qr-code"></i>
        </div>
        <h5 class="mb-0 fw-bold">QR Door</h5>
    </div>

    <div class="card-body">

        <div class="row text-center g-4">

            <div class="col-md-6">

                <span class="badge bg-success bg-opacity-25 text-success-emphasis mb-2">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    QR MASUK
                </span>

                <div>
                    <img
                        width="220"
                        class="border rounded-3 p-2"
                        src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=IN"
                    >
                </div>

            </div>

            <div class="col-md-6">

                <span class="badge bg-danger bg-opacity-25 text-danger-emphasis mb-2">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    QR KELUAR
                </span>

                <div>
                    <img
                        width="220"
                        class="border rounded-3 p-2"
                        src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=OUT"
                    >
                </div>

            </div>

        </div>

    </div>

</div>


{{-- RIWAYAT --}}
<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex align-items-center gap-2">
        <div class="bg-primary bg-opacity-10 text-primary rounded-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width:34px;height:34px;">
            <i class="bi bi-clock-history"></i>
        </div>
        <h5 class="mb-0 fw-bold">Riwayat Door Access</h5>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

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
                                    <i class="bi bi-check-lg"></i>
                                    Allow
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    <i class="bi bi-x-lg"></i>
                                    Deny
                                </span>

                            @endif

                        </td>

                        <td>{{ $log['reason'] }}</td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-1"></i>
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