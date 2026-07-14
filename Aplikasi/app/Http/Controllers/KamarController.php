<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class KamarController extends Controller
{
    public function index()
{
    $response = Http::get('http://host.docker.internal:8001/api/kamar');

    $kamars = $response->json()['kamar'];

    if (Auth::check() && Auth::user()->status_user === 'active') {
    return redirect()->route('dashboard');
    }

    // return view('dashboard.kamar', compact('kamars'));
    return view('home', compact('kamars'));
}

public function kamarindex()
{
    $id = Auth::id();

    $response = Http::get(
        "http://host.docker.internal:8001/api/penyewaans/penyewa/".$id
    );

    $kamars = $response->json()['data'];


    return view('dashboard.kamar',compact('kamars'));
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
        

        $data = $response->json();

        if ($response->successful()) {

            return redirect()
                ->back()
                ->with('snapToken', $data['snap_token'])
                ->with('success', $data['message']);
        }

        return back()->with('error', 'Gagal membuat penyewaan');
    }
}
