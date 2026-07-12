<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KamarController extends Controller
{
    public function index()
{
    $response = Http::get('http://host.docker.internal:8001/api/kamar');

    $kamars = $response->json()['kamar'];

    return view('dashboard.kamar', compact('kamars'));
}

public function sewa(Request $request)
    {
        $response = Http::post(
            'http://host.docker.internal:8001/api/penyewaans',
            [
                'penyewa_id' => $request->penyewa_id,
                'kamar_id'    => $request->kamar_id,
                'start'       => $request->start,
                'end'         => $request->end,
            ]
        );

        if ($response->successful()) {

            return redirect()
                ->back()
                ->with('success', 'Berhasil menyewa kamar');

        }

        return redirect()
            ->back()
            ->with('error', 'Gagal menyewa kamar');
    }
}
