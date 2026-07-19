<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminDashboardController extends Controller
{
     public function dashboard()
    {
        // Total User
        $userResponse = Http::get("http://host.docker.internal/api/users");
        $users = $userResponse->json()['data'] ?? [];

        // Total Kamar
        $kamarResponse = Http::get("http://host.docker.internal:8001/api/kamar");
        $kamars = $kamarResponse->json()['kamar'] ?? [];

        // Total Laporan
        $laporanResponse = Http::get("http://host.docker.internal:8001/api/laporan");
        $laporans = $laporanResponse->json()['data'] ?? [];

        return view('dashboard_admin.dashboard',[
            'jumlahUser'    => count($users),
            'jumlahKamar'   => count($kamars),
            'jumlahLaporan' => count($laporans),
        ]);
    }
}
