<?php

namespace App\Http\Controllers;

use App\Models\DoorLog;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class DoorController extends Controller
{
    public function index()
{
    $reader = Http::get(
        "http://host.docker.internal:8001/api/readers"
    );

    $log = Http::get(
        "http://host.docker.internal:8001/api/doorlogs/user/".Auth::id()
    );

    $readers = [];

    $logs = [];

    if($reader->successful()){

        $readers = $reader->json()['data'];

    }

    if($log->successful()){

        $logs = $log->json()['data'];

    }

    return view(
        'dashboard.doorlog',
        compact(
            'readers',
            'logs'
        )
    );
}

public function access(Request $request)
{
    $response = Http::post(

        "http://host.docker.internal:8001/api/door/validate",

        [

            'reader_id'=>$request->reader_id,
            'qr_code' => $request->qr_code,
            'user_id'=>Auth::id()
            

        ]

    );

    return response()->json(

        $response->json(),

        $response->status()

    );
}
}
