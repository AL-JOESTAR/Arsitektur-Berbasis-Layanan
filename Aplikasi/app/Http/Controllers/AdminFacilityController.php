<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminFacilityController extends Controller
{
     public function index()
    {
        $facility=[];

        $response=Http::get(

            "http://host.docker.internal:8001/api/facilities"

        );

        if($response->successful()){

            $facility=$response->json()['data'];

        }

        return view(

            'dashboard_admin.facility',

            compact('facility')

        );
    }

    public function store(Request $request)
    {
        Http::post(

            "http://host.docker.internal:8001/api/facilities",

            [

                'name'=>$request->name

            ]

        );

        return back();
    }

    public function update(Request $request,$id)
    {
        Http::put(

            "http://host.docker.internal:8001/api/facilities/".$id,

            [

                'name'=>$request->name

            ]

        );

        return back();
    }

    public function destroy($id)
    {
        Http::delete(

            "http://host.docker.internal:8001/api/facilities/".$id

        );

        return back();
    }
}
