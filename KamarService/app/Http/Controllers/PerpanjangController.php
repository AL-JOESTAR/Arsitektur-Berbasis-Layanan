<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PerpanjangController extends Controller
{
    public function index($id)
    {

        $response = Http::get(
            "http://host.docker.internal:8001/api/penyewaans/".$id
        );

        if(!$response->successful()){
            abort(404);
        }

        $penyewaan = $response->json()['data'];

        return view('dashboard.perpanjang',compact('penyewaan'));

    }
    
}
