<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class MidtransController extends Controller
{
    public function notification(Request $request)
    {

        $orderId = $request->order_id;
        $status = $request->transaction_status;
        $fraud = $request->fraud_status;

        $pembayaran = Pembayaran::where('order_id',$orderId)
                ->with('penyewaan.kamar')
                ->first();

        if(!$pembayaran){
            return response()->json([
                'message'=>'Pembayaran tidak ditemukan'
            ],404);
        }

        if(
            $status == 'settlement' ||
            ($status == 'capture' && $fraud == 'accept')
        ){
            $pembayaran->status_bayar='paid';
            $pembayaran->tanggal_bayar=now();
            $pembayaran->save();

            $penyewaan = $pembayaran->penyewaan;
            $penyewaan->status_sewa='AKTIF';
            $penyewaan->save();

            $kamar = $penyewaan->kamar;
            $kamar->status_kamar='aktif';
            $kamar->save();
            }

        else{
            $pembayaran->status_bayar = 'failed';
            $pembayaran->save();
        }

            Http::patch(
            "http://host.docker.internal/api/users/".$penyewaan->penyewa_id."/status",
            [
                'status_user' => 'active'
            ]
        );


        return response()->json([
            'success' => true,
            'message' => 'Callback berhasil diproses'
        ]);


    }
}
