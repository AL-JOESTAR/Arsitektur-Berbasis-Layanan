<?php

namespace App\Http\Controllers;

use App\Models\DoorLog;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class AdminDoor extends Controller
{
     public function index()
    {
         $response = Http::get(
        "http://host.docker.internal:8001/api/admin/doorlogs"
    );

    $logs = [];

    if ($response->successful()) {

        $logs = $response->json()['data'];

        foreach ($logs as &$log) {

            $user = Http::get(
                "http://host.docker.internal/api/users/" . $log['user_id']
            );

            if ($user->successful()) {

                $log['nama_user'] = $user['data']['name'];

            } else {

                $log['nama_user'] = '-';

            }
        }
    }

    return view(
        'dashboard_admin.doorlog',
        compact('logs')
    );
    }
}
