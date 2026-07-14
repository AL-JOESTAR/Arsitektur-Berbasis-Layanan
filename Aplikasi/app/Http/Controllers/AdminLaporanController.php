<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminLaporanController extends Controller
{
     public function index()
    {

        $response = Http::get(
            'http://host.docker.internal:8001/api/laporan'
        );

        $laporans = [];

        if($response->successful()){

            $laporans = $response->json()['data'];

        }

        return view('dashboard_admin.laporan',compact('laporans'));

    }

    public function update(Request $request,$id)
    {

        Http::put(

            "http://host.docker.internal:8001/api/laporan/".$id,

            [

                'status_laporan'=>$request->status_laporan

            ]

        );

        return back()->with('success','Status berhasil diperbarui.');

    }
}
