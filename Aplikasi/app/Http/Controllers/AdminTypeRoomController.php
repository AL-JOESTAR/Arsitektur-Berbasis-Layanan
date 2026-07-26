<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class AdminTypeRoomController extends Controller
{
      public function index()
    {
        $response = Http::get(
            "http://host.docker.internal:8001/api/type-room"
        );

        $typeRoom = [];

        if ($response->successful()) {

            $typeRoom = $response->json()['data'];

        }

        return view(
            'dashboard_admin.typeroom',
            compact('typeRoom')
        );
    }

    public function store(Request $request)
    {
        Http::post(
            "http://host.docker.internal:8001/api/type-room",
            [

                'name' => $request->name,

                'price' => $request->price

            ]
        );

        return back()->with(
            'success',
            'Type Room berhasil ditambahkan'
        );
    }

    public function update(Request $request, $id)
    {
        Http::put(
            "http://host.docker.internal:8001/api/type-room/".$id,
            [

                'name' => $request->name,

                'price' => $request->price

            ]
        );

        return back()->with(
            'success',
            'Type Room berhasil diubah'
        );
    }

    public function destroy($id)
    {
        Http::delete(
            "http://host.docker.internal:8001/api/type-room/".$id
        );

        return back()->with(
            'success',
            'Type Room berhasil dihapus'
        );
    }
}
