<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(){
       $kamar = Kamar::with('typeRoom')
        ->where('status_kamar', 'Tersedia')
        ->get();

         return response()->json([
                'success' => true,
                'kamar' => $kamar,
            ], 200);

    }

    public function adminIndex()
    {
        $kamar = Kamar::with('typeRoom')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data kamar',
            'data' => $kamar
        ]);
    }

    public function show($id)
    {
        $kamar = Kamar::with('typeRoom')->find($id);

        if (!$kamar) {

            return response()->json([
                'success' => false,
                'message' => 'Data kamar tidak ditemukan'
            ],404);

        }

        return response()->json([
            'success'=>true,
            'data'=>$kamar
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'Nomor_Kamar'=>'required|unique:kamars',

            'type_room_id'=>'required|exists:type_rooms,id',

            'status_kamar'=>'required'

        ]);

        $kamar = Kamar::create([

            'Nomor_Kamar'=>$request->Nomor_Kamar,

            'type_room_id'=>$request->type_room_id,

            'status_kamar'=>$request->status_kamar

        ]);

        return response()->json([

            'success'=>true,

            'message'=>'Kamar berhasil ditambahkan',

            'data'=>$kamar

        ],201);
    }

    public function update(Request $request,$id)
    {
        $kamar = Kamar::find($id);

        if(!$kamar){

            return response()->json([

                'success'=>false,

                'message'=>'Kamar tidak ditemukan'

            ],404);

        }

        $request->validate([

            'Nomor_Kamar'=>'required',

            'type_room_id'=>'required|exists:type_rooms,id',

            'status_kamar'=>'required'

        ]);

        $kamar->update([

            'Nomor_Kamar'=>$request->Nomor_Kamar,

            'type_room_id'=>$request->type_room_id,

            'status_kamar'=>$request->status_kamar

        ]);

        return response()->json([

            'success'=>true,

            'message'=>'Data kamar berhasil diupdate',

            'data'=>$kamar

        ]);
    }

    public function destroy($id)
{
    $kamar = Kamar::find($id);

    if(!$kamar){

        return response()->json([

            'success'=>false,

            'message'=>'Kamar tidak ditemukan'

        ],404);

    }

    $kamar->delete();

    return response()->json([

        'success'=>true,

        'message'=>'Data kamar berhasil dihapus'

    ]);
}
}
