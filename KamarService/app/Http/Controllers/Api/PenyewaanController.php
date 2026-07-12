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
        'penyewa_id' => 'required|integer',
        'kamar_id'   => 'required|integer',
        'start'      => 'required|date',
        'end'        => 'required|date|after:start',
    ]);

    try {

        // Cek user ke aplikasi utama
        $response = Http::get(
            "http://host.docker.internal/api/users/{$request->penyewa_id}"
        );

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'User (Penyewa) tidak ditemukan.',
                'status'  => $response->status(),
            ], 404);
        }

        // Simpan penyewaan
        $penyewaan = Penyewaan::create([
            'penyewa_id' => $request->penyewa_id,
            'kamar_id'   => $request->kamar_id,
            'start'      => $request->start,
            'end'        => $request->end,
            'status_sewa'=> 'PENDING',
        ]);

        // Ambil harga kamar (jika relasi tersedia)
        $penyewaan->load('kamar.typeRoom');

        $hargaKamar = 0;

        if ($penyewaan->kamar && $penyewaan->kamar->typeRoom) {
            $hargaKamar = $penyewaan->kamar->typeRoom->price;
        }

        // Buat tagihan awal
        $pembayaran = Pembayaran::create([
            'penyewaan_id'     => $penyewaan->id,
            'tanggal_bayar'    => null,
            'jenis_pembayaran' => 'awal',
            'periode'          => 1,
            'nominal'          => $hargaKamar,
            'status_bayar'     => 'pending',
            'jatuh_tempo'      => now()->addDay(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Penyewaan dan tagihan berhasil dibuat.',
            'data' => [
                'penyewaan'  => $penyewaan,
                'pembayaran' => $pembayaran,
            ]
        ], 201);

    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
        ], 500);
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
