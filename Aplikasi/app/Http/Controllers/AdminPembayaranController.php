<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class AdminPembayaranController extends Controller
{
     public function index()
    {
        $response = Http::get(
            "http://host.docker.internal:8001/api/admin/pembayaran"
        );

        $history = Http::get(
            "http://host.docker.internal:8001/api/admin/riwayat-pembayaran"
        );

        $penyewaan = [];

        if ($response->successful()) {

            $penyewaan = $response->json()['data'];

        }

        foreach ($penyewaan as &$item) {

            $user = Http::get(
                "http://host.docker.internal/api/users/".$item['penyewa_id']
            );

            $item['nama_penyewa'] = $user->successful()
                ? $user['data']['name']
                : '-';

        }

        $riwayat = [];

        if ($history->successful()) {

            $riwayat = $history->json()['data'];

        }

        foreach ($riwayat as &$item) {

            $user = Http::get(
                "http://host.docker.internal/api/users/".$item['penyewaan']['penyewa_id']
            );

            $item['nama_penyewa'] = $user->successful()
                ? $user['data']['name']
                : '-';

        }

        return view(
            'dashboard_admin.pembayaran',
            compact(
                'penyewaan',
                'riwayat'
            )
        );
    }
}
