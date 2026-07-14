<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LaporanController extends Controller
{
     public function index()
    {

        $laporan = Laporan::with('penyewaan.kamar')->get();

        return response()->json([

            'success'=>true,

            'data'=>$laporan

        ]);

    }

    public function store(Request $request)
    {

        $request->validate([

            'penyewaan_id'=>'required',

            'deskripsi'=>'required'

        ]);

        $penyewaan = Penyewaan::find($request->penyewaan_id);

        if(!$penyewaan){

            return response()->json([

                'success'=>false,

                'message'=>'Penyewaan tidak ditemukan'

            ],404);

        }

        if($penyewaan->status_sewa!="Aktif"){

            return response()->json([

                'success'=>false,

                'message'=>'Penyewaan belum aktif'

            ],400);

        }

        $laporan = Laporan::create([

            'penyewaan_id'=>$request->penyewaan_id,

            'deskripsi'=>$request->deskripsi,

            'waktu_laporan'=>now(),

            'status_laporan'=>'menunggu'

        ]);

        return response()->json([

            'success'=>true,

            'message'=>'Laporan berhasil dibuat',

            'data'=>$laporan

        ]);

    }

    public function update(Request $request,$id)
    {

        $laporan = Laporan::findOrFail($id);

        $laporan->status_laporan = $request->status_laporan;

        $laporan->save();

        return response()->json([

            'success'=>true,

            'message'=>'Status berhasil diubah'

        ]);

    }
}
