<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class AdminKamarController extends Controller
{
    // Menampilkan semua kamar
    public function adminKamar()
    {
        $response = Http::get("http://host.docker.internal:8001/api/kamar/index");

        $kamars = $response->json()['data'];

        return view('dashboard_admin.kamar', compact('kamars'));
    }

    // Simpan kamar baru
    public function store(Request $request)
    {
        $request->validate([
            'Nomor_Kamar' => 'required',
            'type_room_id' => 'required|in:1,2,3',
            'status_kamar' => 'required'
        ]);

        Http::post("http://host.docker.internal:8001/api/kamar",[
            'Nomor_Kamar' => $request->Nomor_Kamar,
            'type_room_id' => $request->type_room_id,
            'status_kamar' => $request->status_kamar
        ]);

        return back()->with('success','Kamar berhasil ditambahkan');
    }

    // Update kamar
    public function update(Request $request,$id)
    {
        $request->validate([
            'Nomor_Kamar' => 'required',
            'type_room_id' => 'required|in:1,2,3',
            'status_kamar' => 'required'
        ]);

        Http::put("http://host.docker.internal:8001/api/kamar/$id",[
            'Nomor_Kamar' => $request->Nomor_Kamar,
            'type_room_id' => $request->type_room_id,
            'status_kamar' => $request->status_kamar
        ]);

        return back()->with('success','Data berhasil diupdate');
    }

    // Hapus kamar
    public function destroy($id)
    {
        Http::delete("http://host.docker.internal:8001/api/kamar/$id");

        return back()->with('success','Data berhasil dihapus');
    }
}
