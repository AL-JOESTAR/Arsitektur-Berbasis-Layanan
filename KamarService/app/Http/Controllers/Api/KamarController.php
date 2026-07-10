<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(){
       $kamar = Kamar::get();

         return response()->json([
                'success' => true,
                'kamar' => $kamar,
            ], 200);

    }
}
