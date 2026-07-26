<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\TypeRoom;
use Illuminate\Http\Request;

class TypeRoomController extends Controller
{
    public function index()
    {
        return response()->json([

            'success' => true,

            'data' => TypeRoom::latest()->get()

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'price' => 'required|numeric'

        ]);

        TypeRoom::create([

            'name' => $request->name,

            'price' => $request->price

        ]);

        return response()->json([

            'success' => true,

            'message' => 'Type Room berhasil ditambahkan'

        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required',

            'price' => 'required|numeric'

        ]);

        TypeRoom::findOrFail($id)->update([

            'name' => $request->name,

            'price' => $request->price

        ]);

        return response()->json([

            'success' => true,

            'message' => 'Type Room berhasil diubah'

        ]);
    }

    public function destroy($id)
    {
        TypeRoom::findOrFail($id)->delete();

        return response()->json([

            'success' => true,

            'message' => 'Type Room berhasil dihapus'

        ]);
    }

    public function facilities($id)
{
    $typeRoom = TypeRoom::with('facilities')
                    ->findOrFail($id);

    $facilities = Facility::all();

    return response()->json([

        'success'=>true,

        'type_room'=>$typeRoom,

        'facilities'=>$facilities

    ]);
}

public function saveFacilities(Request $request,$id)
{

    $request->validate([

        'facilities'=>'array'

    ]);

    $typeRoom = TypeRoom::findOrFail($id);

    $typeRoom
        ->facilities()
        ->sync(

            $request->facilities

        );

    return response()->json([

        'success'=>true,

        'message'=>'Fasilitas berhasil diperbarui'

    ]);

}
}
