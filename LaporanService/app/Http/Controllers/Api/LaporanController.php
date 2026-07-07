<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    // Menampilkan semua laporan
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Laporan::all()
        ]);
    }

    // Menyimpan laporan baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_id' => 'required|integer',
            'deskripsi' => 'required|string',
            'waktu_laporan' => 'required|date',
            'status_laporan' => 'required|in:menunggu,diproses,selesai',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $laporan = Laporan::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dibuat.',
            'data' => $laporan
        ], 201);
    }

    // Menampilkan detail laporan
    public function show($id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $laporan
        ]);
    }

    // Update laporan
    public function update(Request $request, $id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'penyewaan_id' => 'sometimes|integer',
            'deskripsi' => 'sometimes|string',
            'waktu_laporan' => 'sometimes|date',
            'status_laporan' => 'sometimes|in:menunggu,diproses,selesai',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $laporan->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil diperbarui.',
            'data' => $laporan
        ]);
    }

    // Hapus laporan
    public function destroy($id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan.'
            ], 404);
        }

        $laporan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dihapus.'
        ]);
    }
}
