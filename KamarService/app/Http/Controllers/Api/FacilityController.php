<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
     public function index()
    {
        return response()->json([

            'success'=>true,

            'data'=>Facility::all()

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'name'=>'required'

        ]);

        Facility::create([

            'name'=>$request->name

        ]);

        return response()->json([

            'success'=>true

        ]);
    }

    public function update(Request $request,$id)
    {
        $request->validate([

            'name'=>'required'

        ]);

        Facility::findOrFail($id)->update([

            'name'=>$request->name

        ]);

        return response()->json([

            'success'=>true

        ]);
    }

    public function destroy($id)
    {
        Facility::findOrFail($id)->delete();

        return response()->json([

            'success'=>true

        ]);
    }
}
