<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        'kamar_id' => 'required',
        'start' => 'required|date',
        'end' => 'required|date',
    ]);

    // 2. Tembak API Aplikasi Utama untuk cek apakah User ada
    $response = Http::get("http://host.docker.internal/api/users/{$request->penyewa_id}");

    // 3. Jika user tidak ditemukan di Aplikasi Utama, gagalkan proses sewa
    if ($response->failed()) {
        return response()->json(['message' => 'User (Penyewa) tidak ditemukan!'], 404);
    }

    // 4. Jika user ada, baru simpan data ke tabel penyewaan
    // $penyewaan = Penyewaan::create([
    //     'penyewa_id' => $request->penyewa_id, // tetap disimpan sebagai ID biasa
    //     'kamar_id' => $request->kamar_id,
    //     'start' => $request->start,
    //     'end' => $request->end,
    //     'status_sewa' => 'PENDING', // status awal
    // ]);

    // return response()->json($penyewaan, 201);

    $penyewaan = Penyewaan::create([
    'penyewa_id' => $request->penyewa_id,
    'kamar_id' => $request->kamar_id,
    'start' => $request->start,
    'end' => $request->end,
    'status_sewa' => 'PENDING',
]);

   $penyewaan->load('kamar.typeRoom');
    $hargaKamar = $penyewaan->kamar->typeRoom->price ?? 0;

    // 5. OTOMATIS: Simpan data tagihan awal di tabel pembayaran lokal
    $pembayaran = Pembayaran::create([
        'penyewaan_id' => $penyewaan->id,
        'tanggal_bayar' => null, // null karena belum bayar
        'jenis_pembayaran' => 'awal',
        'periode' => 1, // default sewa 1 bulan di awal
        'nominal' => $hargaKamar, // Harga otomatis terisi dari tipe kamar
        'status_bayar' => 'pending',
        'jatuh_tempo' => now()->addDays(1), // Batas bayar 24 jam
    ]);

    // 6. Kembalikan response sukses beserta ID Pembayaran untuk dipakai Midtrans nanti
    return response()->json([
        'success' => true,
        'message' => 'Penyewaan dan Tagihan berhasil dibuat!',
        'data' => [
            'penyewaan_id' => $penyewaan->id,
            'pembayaran_id' => $pembayaran->id // Dilempar balik ke form javascript tadi
        ]
    ], 201);

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
