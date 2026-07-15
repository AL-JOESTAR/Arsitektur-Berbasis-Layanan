<?php

namespace App\Http\Controllers;

use App\Models\DoorLog;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoorController extends Controller
{
     public function index()
{
    $readers = Reader::all();

    $logs = DoorLog::where('user_id', Auth::id())
                    ->latest()
                    ->get();

    return view('dashboard.doorlog', compact('readers','logs'));
}

    
public function scan($readerId)
{
    $user = Auth::user();

    $reader = Reader::findOrFail($readerId);

    if ($user->status_user != 'active') {

        DoorLog::create([
            'reader_id' => $reader->id,
            'user_id' => $user->id,
            'scan_time' => now(),
            'access_result' => 'deny',
            'reason' => 'user_inactive',
        ]);

        return response()->json([
            'message' => 'Access Denied'
        ], 403);
    }

    DoorLog::create([
        'reader_id' => $reader->id,
        'user_id' => $user->id,
        'scan_time' => now(),
        'access_result' => 'allow',
        'reason' => 'success',
    ]);

    return response()->json([
        'message' => 'Access Allowed'
    ]);
}
}
