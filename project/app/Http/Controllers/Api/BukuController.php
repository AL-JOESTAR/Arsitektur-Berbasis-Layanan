<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

final class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::orderBy('judul', 'asc')->get(); // ini untuk mengambil dan mengurutkan buku dari huruf A

        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ///Validasi dulu
        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json([
            'status' => false,
            'message' => 'gagal memasukan data',
            'data' => $validator->errors(),
        ], 404);
        }

        //Create
        $dataBuku = new Buku;
        $dataBuku -> judul =$request->judul;
        $dataBuku -> pengarang =$request->pengarang;
        $dataBuku -> tanggal_publikasi =$request->tanggal_publikasi;

        $post = $dataBuku->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses',
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Buku::find($id);
        if($data){
        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $data,
        ], 200);
        } else {
        return response()->json([
            'status' => false,
            'message' => 'data tidak ditemukan',
        ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json([
            'status' => false,
            'message' => 'gagal memasukan data',
            'data' => $validator->errors(),
        ], 404);
        }

        //Create
        $dataBuku = Buku::find($id);
        if(empty($dataBuku)){
        return response()->json([
            'status' => false,
            'message' => 'data tidak berhasil di update',
        ], 404);
        }

        $dataBuku -> judul =$request->judul;
        $dataBuku -> pengarang =$request->pengarang;
        $dataBuku -> tanggal_publikasi =$request->tanggal_publikasi;

        $post = $dataBuku->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses di update',
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataBuku = Buku::find($id);
        if(empty($dataBuku)){
        return response()->json([
            'status' => false,
            'message' => 'data tidak berhasil di update',
        ], 404);
        }


        $post = $dataBuku->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses di delete',
        ], 200);

    }
}
