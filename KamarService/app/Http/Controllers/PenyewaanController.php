<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PenyewaanController extends Controller
{
    public function store(Request $request)
{
    // 1. Validasi input biasa (kamar_id, start, end, dll)
    $request->validate([
        'penyewa_id' => 'required',
        'kamar_id' => 'required',
        'start' => 'required|date',
        'end' => 'required|date',
    ]);

    // 2. Tembak API Aplikasi Utama untuk cek apakah User ada
    $response = Http::get("http://localhost/api/users" . $request->penyewa_id);

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
}
