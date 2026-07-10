<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PembayaranController extends Controller
{
    public function getSnapToken($id)
{
    $pembayaran = Pembayaran::find($id);

    // Setup konfigurasi Midtrans
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = false; // false untuk sandbox
    Config::$isSanitized = true;
    Config::$is3ds = true;

    // Buat parameter transaksi
    $params = [
        'transaction_details' => [
            'order_id' => 'PAY-' . $pembayaran->id . '-' . time(), // Harus unik
            'gross_amount' => (int) $pembayaran->nominal,
        ],
        // Kamu bisa menambahkan data item atau customer di sini jika perlu
    ];

    try {
        // Ambil Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($params);
        
        return response()->json([
            'success' => true,
            'snap_token' => $snapToken
        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}
}
