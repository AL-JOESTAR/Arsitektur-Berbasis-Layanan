<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <!-- Favicon-->
        <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">Wellcome {{ Auth::user()->name }}</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/dashboard">Dashboard</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/kamar">Kamar</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/laporan">laporan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/pembayaran">Events</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Profile</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Status</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        @auth
                        @if (auth()->check() && auth()->user()->email == 'admin@admin.com')
                        <a class="btn btn-primary m-2" href="/dashboard/qr">QR</a>
                        @endif
                        @endauth
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Something else here</a>
                                        <form method="POST" action="/logout">
                                @csrf
                        <button type="submit">Logout</button>
                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
                    <h1 class="mt-4">Ini untuk kamar</h1>
                    <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
                    <p>
                        Make sure to keep all page content within the
                        <code>#page-content-wrapper</code>
                        . The top navbar is optional, and just for demonstration. Just create an element with the
                        <code>#sidebarToggle</code>
                        ID which will toggle the menu when clicked.
                    </p>
                </div>
            </div>

            <div class="container">
                <form id="form-sewa">
    <input type="hidden" id="penyewa_id" value="{{ auth()->user()->id }}"> 
    <input type="hidden" id="kamar_id" value="$kamar->id"> 

    <div class="form-group">
        <label>Tanggal Mulai</label>
        <input type="date" id="start" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Tanggal Selesai</label>
        <input type="date" id="end" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Konfirmasi Sewa</button>
</form>

<script>
document.getElementById('form-sewa').addEventListener('submit', function(e) {
    e.preventDefault();

    // Mengumpulkan data form
    let dataSewa = {
        penyewa_id: document.getElementById('penyewa_id').value, // Isinya: 1
        kamar_id: document.getElementById('kamar_id').value,     // Isinya: id kamar
        start: document.getElementById('start').value,
        end: document.getElementById('end').value
    };

    // KIRIM (POST) KE SERVICE KAMAR (Port 8001)
    fetch('http://localhost:8001/api/penyewaans', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(dataSewa)
    })
    .then(response => response.json())
    .then(result => {
        if(result.success) {
            alert('Sewa Kamar Berhasil di-Booking! Silahkan lakukan pembayaran.');
            // Arahkan Budi ke halaman pembayaran bawa data pembayaran_id yang baru dibuat otomatis
            window.location.href = '/pembayaran/' + result.data.pembayaran_id;
        } else {
            alert('Gagal sewa: ' + result.message);
        }
    });
});
</script>
            </div>
        </div>

        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
    </body>
</html>
