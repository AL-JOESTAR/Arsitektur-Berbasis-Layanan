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

        $typeRooms = [];

        if ($response->successful()) {

            $typeRooms = $response->json()['data'];

        }

        return view(
            'dashboard_admin.typeroom',
            compact('typeRooms')
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

    public function facilities($id)
{

    $response = Http::get(

        "http://host.docker.internal:8001/api/type-room/$id/facilities"

    );

    $data = $response->json();

    return view(

        'dashboard_admin.type_room_facility',

        [

            'typeRoom'=>$data['type_room'],

            'facilities'=>$data['facilities']

        ]

    );

}

public function saveFacilities(Request $request,$id)
{

    Http::post(

        "http://host.docker.internal:8001/api/type-room/$id/facilities",

        [

            'facilities'=>$request->facilities

        ]

    );

    return redirect()

        ->back()

        ->with(

            'success',

            'Fasilitas berhasil diperbarui'

        );

}
}
