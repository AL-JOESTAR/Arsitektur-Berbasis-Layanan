<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;

class PenyewaanController extends Controller
{
     public function index()
    {
        $data = Penyewaan::with('kamar')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data penyewaan',
            'data' => $data
        ]);
    }

    /**
     * POST /api/penyewaans
     */
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

    /**
     * GET /api/penyewaans/{id}
     */
    public function show($id)
    {
        // Panggil relasi kamar, dan sekalian ambil data TypeRoom di dalam kamar tersebut
    $penyewaan = Penyewaan::with(['kamar.typeRoom'])->find($id);

    if (!$penyewaan) {
        return response()->json([
            'success' => false,
            'message' => 'Data penyewaan tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $penyewaan
    ], 200);
    }

    /**
     * PUT /api/penyewaans/{id}
     */
    public function update(Request $request, $id)
    {
        $penyewaan = Penyewaan::find($id);

        if (!$penyewaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'penyewa_id' => 'required|integer',
            'kamar_id' => 'required|exists:kamars,id',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'status_sewa' => 'required|in:Pending,Aktif,Batal,Selesai'
        ]);

        $penyewaan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $penyewaan
        ]);
    }

    /**
     * DELETE /api/penyewaans/{id}
     */
    public function destroy($id)
    {
        $penyewaan = Penyewaan::find($id);

        if (!$penyewaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $penyewaan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function getByPenyewa($penyewa_id)
    {
        $data = Penyewaan::with('kamar')
            ->where('penyewa_id', $penyewa_id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data penyewaan berdasarkan penyewa',
            'data' => $data
        ]);
    }
}
