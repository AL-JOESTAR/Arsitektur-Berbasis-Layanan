<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LaporanController extends Controller
{
     public function index()
    {


        $userId = Auth::id();

        // ambil penyewaan user
        $response = Http::get(
            "http://host.docker.internal:8001/api/penyewaans/penyewa/".$userId
        );


        if (!$response->successful()) {
            return back()->with('error', 'Data penyewaan tidak ditemukan.');
        }

        $penyewaan = collect($response->json()['data'])
            ->firstWhere('status_sewa', 'Aktif');

        if (!$penyewaan) {
            return back()->with('error', 'Anda belum memiliki penyewaan aktif.');
        }

        
        

        return view('dashboard.laporan',compact('penyewaan'));

    }

    public function store(Request $request)
    {
         $request->validate([
        'penyewaan_id' => 'required',
        'deskripsi' => 'required'
    ]);

    $response = Http::post(
        "http://host.docker.internal:8001/api/laporan",
        [
            'penyewaan_id' => $request->penyewaan_id,
            'deskripsi' => $request->deskripsi
        ]
    );

    if($response->successful()){
        return back()->with('success','Laporan berhasil dikirim.');
    }

    return back()->with('error','Gagal mengirim laporan.');
    }
}
