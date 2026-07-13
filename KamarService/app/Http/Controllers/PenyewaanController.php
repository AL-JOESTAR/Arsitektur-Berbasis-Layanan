<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;

class PenyewaanController extends Controller
{
//     public function store(Request $request)
// {
//     // 1. Validasi input biasa (kamar_id, start, end, dll)
//     $request->validate([
//         'penyewa_id' => 'required',
//         'kamar_id' => 'required',
//         'start' => 'required|date',
//         'end' => 'required|date',
//     ]);

//     // 2. Tembak API Aplikasi Utama untuk cek apakah User ada
//     $response = Http::get("http://localhost/api/users" . $request->penyewa_id);

//     // 3. Jika user tidak ditemukan di Aplikasi Utama, gagalkan proses sewa
//     if ($response->failed()) {
//         return response()->json(['message' => 'User (Penyewa) tidak ditemukan!'], 404);
//     }

//     // 4. Jika user ada, baru simpan data ke tabel penyewaan
//     $penyewaan = Penyewaan::create([
//         'penyewa_id' => $request->penyewa_id, // tetap disimpan sebagai ID biasa
//         'kamar_id' => $request->kamar_id,
//         'start' => $request->start,
//         'end' => $request->end,
//         'status_sewa' => 'PENDING', // status awal
//     ]);

//     return response()->json($penyewaan, 201);
// }

public function store(Request $request)
{
    $request->validate([
        'penyewa_id' => 'required',
        'kamar_id'   => 'required',
        'start'      => 'required|date',
        'end'        => 'required|date|after:start',
    ]);

    DB::beginTransaction();

    try {

        // ==========================
        // Konfigurasi Midtrans
        // ==========================

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // ==========================
        // Cek User di Aplikasi Utama
        // ==========================

        $response = Http::get(
            "http://host.docker.internal/api/users/".$request->penyewa_id
        );

        if ($response->failed()) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ],404);

        }

        $user = $response->json() ['data'];

        // ==========================
        // Simpan Penyewaan
        // ==========================

        $penyewaan = Penyewaan::create([

            'penyewa_id'=>$request->penyewa_id,

            'kamar_id'=>$request->kamar_id,

            'start'=>$request->start,

            'end'=>$request->end,

            'status_sewa'=>'PENDING'

        ]);

        $penyewaan->load('kamar.typeRoom');

        $harga = $penyewaan->kamar->typeRoom->price;

        // ==========================
        // Simpan Pembayaran
        // ==========================

        $pembayaran = Pembayaran::create([

            'penyewaan_id'=>$penyewaan->id,

            'tanggal_bayar'=>null,

            'jenis_pembayaran'=>'awal',

            'periode'=>1,

            'nominal'=>$harga,

            'status_bayar'=>'pending',

            'jatuh_tempo'=>now()->addDay()

        ]);

        // ==========================
        // Parameter Midtrans
        // ==========================

        $params = [

            'transaction_details'=>[

                'order_id'=>'ORDER-'.$pembayaran->id,

                'gross_amount'=>$harga

            ],

            'customer_details'=>[

                'first_name'=>$user['name'] ?? 'Penyewa',

                'email'=>$user['email'] ?? ''

            ],

            'item_details'=>[

                [

                    'id'=>$penyewaan->kamar_id,

                    'price'=>$harga,

                    'quantity'=>1,

                    'name'=>'Sewa Kamar'

                ]

            ]

        ];

        // ==========================
        // Generate Snap Token
        // ==========================

        $snapToken = Snap::getSnapToken($params);

        $pembayaran->snap_token = $snapToken;

        $pembayaran->save();

        DB::commit();

        return response()->json([

            'success'=>true,

            'message'=>'Penyewaan berhasil',

            'snap_token'=>$snapToken,

            'data'=>[

                'penyewaan'=>$penyewaan,

                'pembayaran'=>$pembayaran

            ]

        ],201);

    }

    catch(\Exception $e){

        DB::rollBack();

        return response()->json([

            'success'=>false,

            'message'=>$e->getMessage(),

            'line'=>$e->getLine()

        ],500);

    }

}
}
