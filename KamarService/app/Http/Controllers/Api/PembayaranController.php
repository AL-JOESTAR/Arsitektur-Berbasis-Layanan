<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Carbon\Carbon;

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
                'start_time' => time() . ' +0700',
                'unit' => 'minute',
                'duration' => 2,
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

    public function riwayatPenyewa($penyewaId)
{
    $data = Pembayaran::with([
        'penyewaan.kamar.typeRoom'
    ])
    ->whereHas('penyewaan', function ($q) use ($penyewaId) {
        $q->where('penyewa_id', $penyewaId);
    })
    ->where('status_bayar', 'paid')   // Hanya tampilkan yang sudah lunas
    ->orderByDesc('tanggal_bayar')
    ->get();

    return response()->json([
        'success' => true,
        'data' => $data
    ]);
}

public function admin()
{
    $today = Carbon::today();

    $data = Penyewaan::with('kamar')->get();

    foreach($data as $item){

        $end = Carbon::parse($item->end);

        if($today->lte($end)){

            $item->status="Lunas";
            $item->warna="success";

        }

        elseif(

            $today->gt($end) &&
            $today->lte($end->copy()->addDays(7))

        ){

            $item->status="Menunggak";
            $item->warna="warning";

        }

        else{

            $item->status="Tidak Aktif";
            $item->warna="danger";

        }

    }

    return response()->json([

        'success'=>true,

        'data'=>$data

    ]);

}

public function riwayat()
{

         $riwayat = Pembayaran::with([
        'penyewaan.kamar'
    ])
    ->where('status_bayar', 'paid')
    ->orderByDesc('tanggal_bayar')
    ->get();

    return response()->json([
        'success'=>true,
        'data'=>$riwayat
    ]);

}
}