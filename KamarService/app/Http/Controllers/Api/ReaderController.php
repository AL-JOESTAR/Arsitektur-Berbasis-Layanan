<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reader;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    public function index()
    {
        return response()->json([
            'success'=>true,
            'data'=>Reader::all()
        ]);
    }
}
