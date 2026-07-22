<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DoorLog;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DoorController extends Controller
{

        public function user($id)
    {
        $logs = DoorLog::with('reader')
                    ->where('user_id',$id)
                    ->latest()
                    ->get();
        
                     $logs->transform(function ($log) {

        $log->scan_time = $log->scan_time
            ->timezone('Asia/Jakarta')
            ->format('d-m-Y H:i:s');

        return $log;
    });

        return response()->json([
            'success'=>true,
            'data'=>$logs
        ]);
    }

        public function validate(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'qr_code' => 'required'
        ]);

        // Tentukan reader
        if ($request->qr_code == "IN") {

            $readerId = 1;

        } elseif ($request->qr_code == "OUT") {

            $readerId = 2;

        } else {

            return response()->json([
                'success' => false,
                'message' => 'QR tidak valid'
            ], 400);

        }

        DoorLog::create([
            'reader_id'     => $readerId,
            'user_id'       => $request->user_id,
            'scan_time'     => now(),
            'access_result' => 'allow',
            'reason'        => 'success'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Scan berhasil'
        ]);
    }
}
