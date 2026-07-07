<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    $penyewaan = Penyewaan::create([
        'penyewa_id' => $request->penyewa_id, // tetap disimpan sebagai ID biasa
        'kamar_id' => $request->kamar_id,
        'start' => $request->start,
        'end' => $request->end,
        'status_sewa' => 'PENDING', // status awal
    ]);

    return response()->json($penyewaan, 201);
    }

    /**
     * GET /api/penyewaans/{id}
     */
    public function show($id)
    {
        $penyewaan = Penyewaan::with(['kamar', 'penyewa'])->find($id);

        if (!$penyewaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $penyewaan
        ]);
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
