<?php

namespace App\Console\Commands;

use App\Models\Pembayaran;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExpirePembayaranPending extends Command
{
    /**
     * Nama & signature command.
     * Jalankan manual dengan: php artisan pembayaran:expire-pending
     */
    protected $signature = 'pembayaran:expire-pending';

    protected $description = 'Set status pembayaran menjadi expired jika masih pending dan sudah lewat jatuh_tempo (fallback kalau webhook Midtrans gagal masuk)';

    public function handle()
    {
        $pembayarans = Pembayaran::where('status_bayar', 'pending')
            ->where('jatuh_tempo', '<', now())
            ->with('penyewaan.kamar')
            ->get();

        if ($pembayarans->isEmpty()) {
            $this->info('Tidak ada pembayaran pending yang sudah lewat jatuh tempo.');
            return;
        }

        foreach ($pembayarans as $pembayaran) {
            $pembayaran->status_bayar = 'cancelled';
            $pembayaran->save();

            $penyewaan = $pembayaran->penyewaan;

            if ($penyewaan) {
                $penyewaan->status_sewa = 'Batal';
                $penyewaan->save();

                $kamar = $penyewaan->kamar;
                if ($kamar) {
                    $kamar->status_kamar = 'Tersedia';
                    $kamar->save();
                }
            }

            Log::info('Pembayaran auto-expired via scheduler (fallback)', [
                'pembayaran_id' => $pembayaran->id,
                'order_id'      => $pembayaran->order_id,
            ]);

            $this->info("Order {$pembayaran->order_id} -> expired.");
        }

        $this->info('Selesai. Total diproses: '.$pembayarans->count());
    }
}