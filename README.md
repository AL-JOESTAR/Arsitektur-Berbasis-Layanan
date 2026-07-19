### Project Arsitektur berbasis layanan

* Aplikasi utama -> 80/tcp (localhost)
* Kamar Service -> 8001

* ngrok http 8001 (forwarding ke Kamar Service)
* sail artisan pembayaran:expire-pending (untuk cek pembayaran yang expired) 
