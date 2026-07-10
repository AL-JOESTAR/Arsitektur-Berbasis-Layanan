<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PembayaranController extends Controller
{
    public function generateSnapToken($id)
    {
        // 1. Cari data pembayaran lokal
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json(['success' => false, 'message' => 'Data tagihan tidak ditemukan'], 404);
        }

        // 2. Konfigurasi SDK Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION'), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 3. Susun parameter yang dibutuhkan Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'INV-' . $pembayaran->id . '-' . time(), // Harus unik setiap request
                'gross_amount' => (int) $pembayaran->nominal,
            ],
            // Opsional: Batasi metode pembayaran (misal hanya e-wallet dan transfer bank)
            'expiry' => [
                'start' => time() . ' +0700',
                'duration' => 1,
                'unit' => 'days'
            ]
        ];

        try {
            // 4. Minta Snap Token ke Midtrans
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'nominal' => $pembayaran->nominal
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal terhubung ke Midtrans: ' . $e->getMessage()
            ], 500);
        }
    }
}