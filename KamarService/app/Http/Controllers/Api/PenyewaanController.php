<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        'periode'    => 'required|integer|min:1|max:12',
    ]);

    DB::beginTransaction();

    try {

        // ==========================
        // Cek apakah kamar masih tersedia
        // ==========================

        $kamar = Kamar::find($request->kamar_id);

        if (!$kamar) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Kamar tidak ditemukan.'
            ],404);
        }

        if ($kamar->status_kamar != 'Tersedia') {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Kamar sudah tidak tersedia.'
            ],400);
        }

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
        // Hitung tanggal selesai
        // ==========================
        $periode = (int) $request->periode;

        
        $start = Carbon::parse($request->start);
        $end = $start->copy()->addMonths($periode);


        // ==========================
        // Simpan Penyewaan
        // ==========================

        $penyewaan = Penyewaan::create([

            'penyewa_id'=>$request->penyewa_id,

            'kamar_id'=>$request->kamar_id,

            'start'=>$start,

            'end'=>$end,

            'status_sewa'=>'PENDING'

        ]);

        $kamar = $penyewaan->kamar;

        $kamar->status_kamar = 'Reserved';
        $kamar->save();

        $penyewaan->load('kamar.typeRoom');

        $hargaPerBulan = $penyewaan->kamar->typeRoom->price;

        $totalHarga = $hargaPerBulan * $periode;

        // ==========================
        // Simpan Pembayaran
        // ==========================

        $pembayaran = Pembayaran::create([

            'penyewaan_id'=>$penyewaan->id,

            'tanggal_bayar'=>null,

            'jenis_pembayaran'=>'awal',

            'periode'=>$periode,

            'nominal'=>$totalHarga,

            'status_bayar'=>'pending',

            'jatuh_tempo'=>now()->addMinutes(2)

        ]);

        $orderId = 'ORDER-'.$pembayaran->id.'-'.time();

        // ==========================
        // Parameter Midtrans
        // ==========================

        $params = [

            'transaction_details'=>[

                'order_id'=>$orderId,

                'gross_amount'=>$totalHarga

            ],

            'customer_details'=>[

                'first_name'=>$user['name'] ?? 'Penyewa',

                'email'=>$user['email'] ?? ''

            ],

            'item_details'=>[

                [

                    'id'=>$penyewaan->kamar_id,

                    'price'=>$hargaPerBulan,

                    'quantity'=>$periode,

                    'name'=>'Sewa Kamar'

                ]

            ],

            'expiry' => [
            'start_time' => date('Y-m-d H:i:s O'),
            'unit'       => 'minute',
            'duration'   => 2,
        ]

        ];

        // ==========================
        // Generate Snap Token
        // ==========================

        $snapToken = Snap::getSnapToken($params);

        

        $pembayaran->snap_token = $snapToken;
        $pembayaran->order_id = $orderId;
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
    $penyewaan = Penyewaan::with(['kamar'])->find($id);

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
            'periode'    => 'required|integer|min:1|max:12',
            'status_sewa' => 'required|in:Pending,Aktif,Batal,Selesai'
        ]);
        $validated['end'] = Carbon::parse($validated['start'])
        ->addMonths($validated['periode']);

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
        $data = Penyewaan::with('kamar.typeRoom')
            ->where('penyewa_id', $penyewa_id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data penyewaan berdasarkan penyewa',
            'data' => $data
        ]);
    }

    public function perpanjang(Request $request,$id)
    {
        $request->validate([
            'periode'=>'required|integer|min:1|max:12'
        ]);

        $penyewaan = Penyewaan::with('kamar.typeRoom')
        ->find($id);

        if(!$penyewaan){

            return response()->json([
                'success'=>false,
                'message'=>'Penyewaan tidak ditemukan'
            ],404);

        }

        $hargaPerBulan = $penyewaan->kamar->typeRoom->price;

        $total = $hargaPerBulan * (int)$request->periode;

        Config::$serverKey=config('midtrans.serverKey');

        Config::$isProduction=config('midtrans.isProduction');

        Config::$isSanitized=true;

        Config::$is3ds=true;

        $response = Http::get(

        "http://host.docker.internal/api/users/"

        .$penyewaan->penyewa_id

        );

        $user=$response->json()['data'];

        $pembayaran = Pembayaran::create([

        'penyewaan_id'=>$penyewaan->id,

        'tanggal_bayar'=>null,

        'jenis_pembayaran'=>'perpanjangan',

        'periode'=>$request->periode,

        'nominal'=>$total,

        'status_bayar'=>'pending',

        'jatuh_tempo'=>now()->addMinutes(2)

        ]);

        $orderId='ORDER-'.$pembayaran->id.'-'.time();

                $params=[

        'transaction_details'=>[

        'order_id'=>$orderId,

        'gross_amount'=>$total

        ],

        'customer_details'=>[

        'first_name'=>$user['name'],

        'email'=>$user['email']

        ],

        'item_details'=>[[

        'id'=>$penyewaan->kamar_id,

        'price'=>$hargaPerBulan,

        'quantity'=>$request->periode,

        'name'=>'Perpanjangan Sewa'

        ]],

        'expiry'=>[

        'start_time'=>date('Y-m-d H:i:s O'),

        'unit'=>'minute',

        'duration'=>2

        ]

        ];

        $snapToken = Snap::getSnapToken($params);

$pembayaran->order_id = $orderId;
$pembayaran->snap_token = $snapToken;
$pembayaran->save();

                return response()->json([

        'success'=>true,

        'message'=>'Silahkan lakukan pembayaran',

        'snap_token'=>$snapToken

        ]);
    }
}
