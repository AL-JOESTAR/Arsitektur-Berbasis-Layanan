<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class MidtransController extends Controller
{
    public function notification(Request $request)
    {
        $orderId = $request->order_id;
        $status  = $request->transaction_status;
        $fraud   = $request->fraud_status;

        // Log setiap notifikasi masuk, ini kunci untuk debugging
        Log::info('Midtrans notification masuk', [
            'order_id' => $orderId,
            'status'   => $status,
            'fraud'    => $fraud,
        ]);

        $pembayaran = Pembayaran::where('order_id', $orderId)
                ->with('penyewaan.kamar')
                ->first();

        if (!$pembayaran) {
            Log::warning('Pembayaran tidak ditemukan untuk order_id: '.$orderId);
            return response()->json([
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        $penyewaan = $pembayaran->penyewaan;

        if (
            $status == 'settlement' ||
            ($status == 'capture' && $fraud == 'accept')
        ) {
            $pembayaran->status_bayar = 'paid';
            if($pembayaran->jenis_pembayaran=='perpanjangan'){

                $penyewaan = $pembayaran->penyewaan;

                $penyewaan->end = Carbon::parse($penyewaan->end)

                                ->addMonths($pembayaran->periode);

                $penyewaan->save();

            }
            $pembayaran->tanggal_bayar = now();
            $pembayaran->save();

            $penyewaan->status_sewa = 'Aktif';
            $penyewaan->save();

            $kamar = $penyewaan->kamar;
            $kamar->status_kamar = 'Aktif';
            $kamar->save();

            $this->updateUserStatus($penyewaan->penyewa_id, 'active');

        } elseif ($status == 'cancel') {

            $pembayaran->status_bayar = 'cancel';
            $pembayaran->save();

            $penyewaan->status_sewa = 'Batal';
            $penyewaan->save();

            $kamar = $penyewaan->kamar;
            $kamar->status_kamar = 'Tersedia';
            $kamar->save();

        } elseif ($status == 'expire') {

            $pembayaran->status_bayar = 'expired';
            $pembayaran->save();

            $penyewaan->status_sewa = 'Batal';
            $penyewaan->save();

            $kamar = $penyewaan->kamar;
            $kamar->status_kamar = 'Tersedia';
            $kamar->save();

        } elseif ($status == 'deny') {

            $pembayaran->status_bayar = 'denied';
            $pembayaran->save();

        } else {
            // status pending atau status lain yang belum di-handle
            Log::info('Status tidak diproses (kemungkinan pending): '.$status.' order_id: '.$orderId);
        }

        return response()->json([
            'success' => true,
            'message' => 'Callback berhasil diproses'
        ]);
    }

    private function updateUserStatus($penyewaId, $status)
    {
        try {
            $response = Http::patch(
                "http://host.docker.internal/api/users/{$penyewaId}/status",
                ['status_user' => $status]
            );

            if (!$response->successful()) {
                Log::error('Gagal update status user', [
                    'penyewa_id' => $penyewaId,
                    'response'   => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Exception saat update status user: '.$e->getMessage());
        }
    }
}