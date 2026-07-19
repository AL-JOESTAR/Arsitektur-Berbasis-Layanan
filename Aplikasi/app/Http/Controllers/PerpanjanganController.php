<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PerpanjanganController extends Controller
{
     public function index($id)
    {
        $response = Http::get(
            "http://host.docker.internal:8001/api/penyewaans/".$id
        );

        if (!$response->successful()) {
            return back()->with('error', 'Data penyewaan tidak ditemukan.');
        }

        $penyewaan = $response->json()['data'];

        return view('dashboard.perpanjang', compact('penyewaan'));
    }

    public function store(Request $request, $id)
    {
        
        $request->validate([
            'periode' => 'required|integer|min:1|max:12'
        ]);

        $response = Http::post(
            "http://host.docker.internal:8001/api/penyewaans/".$id."/perpanjang",
            [
                'periode' => (int) $request->periode
            ]
        );


        if ($response->successful()) {

            $data = $response->json();

            return redirect()
                ->route('perpanjang.index', $id)
                ->with('success', $data['message'])
                ->with('snapToken', $data['snap_token']);
        }

        return back()->with(
            'error',
            $response->json()['message'] ?? 'Gagal membuat pembayaran perpanjangan.'
        );
    }
}
