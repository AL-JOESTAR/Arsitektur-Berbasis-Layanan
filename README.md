# E-Kos

<p align="center">
<img src="img/Ekos.png">
</p>

<h2>Tentang E-Kos</h2>
<P>
E-Kos adalah sistem informasi penyewaan kos berbasis web yang dirancang untuk mempermudah pengelolaan kos bagi pemilik sekaligus memberikan pengalaman yang lebih praktis bagi penyewa dan orang tua.

Aplikasi ini tidak hanya menyediakan fitur penyewaan kamar secara online, tetapi juga mendukung pembayaran digital melalui Midtrans, akses masuk menggunakan QR Code, pelaporan kerusakan secara real-time, serta monitoring aktivitas keluar masuk penyewa oleh orang tua.

Dengan konsep digitalisasi proses administrasi kos, E-Kos membantu mengurangi pencatatan manual, meningkatkan transparansi pembayaran, dan mempercepat komunikasi antara pemilik dan penyewa.
</P>

## Desain Database

<p align="center">
    <img src="img/database.png" width="900">
</p>

## Hak Akses Pengguna
#### Admin 
* Melihat dashboard
* Kelola Kamar (CRUD) & Update Status kamar
* Kelola Status (update status laporan)
* Melihat seluruh riwayat pembayaran
* Membuat custom Type room dan facility

#### Penyewa
* informasi pengguna
* Log keluar masuk dengan scan qr
* Laporan kerusakan secara online dan tracking status real-time
* informasi tentang kamar
* Riwayat Pemabayran dan perpanjangan
* Membuat akun orang tua

#### Orang Tua
* Melihat log keluar masuk anak mereka

## Tech Stack
- Laravel 13
- Laravel Breeze
- Docker (Laravel sail)
- Bootstrap 5
- Midtrans Snap (payment gateway)
- Rest API
- QR Code

## Arsitektur Sistem

Project menggunakan pendekatan Service-Oriented Architecture (SOA) sehingga beberapa layanan dipisahkan menjadi service tersendiri.

* Aplikasi utama -> 80/tcp (localhost)
* Kamar Service -> 8001
* ngrok http 8001 (forwarding ke Kamar Service untuk mendapat callback dari midtrans)
* sail artisan pembayaran:expire-pending (untuk cek pembayaran yang expired) 