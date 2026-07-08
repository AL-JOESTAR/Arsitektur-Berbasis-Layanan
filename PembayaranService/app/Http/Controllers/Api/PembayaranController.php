<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari user/frontend
        $request->validate([
            'penyewaan_id' => 'required|integer',
            'jenis_pembayaran' => 'required|in:awal,perpanjangan',
            'periode' => 'required|integer|min:1',
        ]);

        // 2. Tembak API Service Kamar (Port 8001) untuk ambil detail penyewaan & harga kamar
        $response = Http::get("http://127.0.0.1:8001/api/penyewaan/" . $request->penyewaan_id);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Penyewaan tidak ditemukan di Service Kamar!'
            ], 404);
        }

        $dataSewa = $response->json()['data'];

        // 3. Ambil harga dari relation nest: kamar -> type_room -> price
        // Sesuaikan dengan nama attribute/kolom di database Service Kamarmu (misal: price atau harga)
        $hargaPerBulan = $dataSewa['kamar']['type_room']['price'] ?? null;

        if (!$hargaPerBulan) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data harga kamar dari Service Kamar.'
            ], 500);
        }

        // 4. Hitung total nominal pembayran
        $totalNominal = $hargaPerBulan * $request->periode;

        // 5. Simpan ke database pembayaran dengan status 'pending'
        $pembayaran = Pembayaran::create([
            'penyewaan_id' => $request->penyewaan_id,
            'tanggal_bayar' => null, // Belum dibayar, jadi null
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'periode' => $request->periode,
            'nominal' => $totalNominal,
            'status_bayar' => 'pending',
            'jatuh_tempo' => now()->addDays(3), // Batas bayar 3 hari dari sekarang
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tagihan pembayaran berhasil dibuat',
            'data' => $pembayaran
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
