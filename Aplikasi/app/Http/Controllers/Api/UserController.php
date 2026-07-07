<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
        // GET semua user
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'message' => 'Data users berhasil diambil',
            'data' => $users
        ], 200);
    }

    // GET user berdasarkan id
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail user berhasil diambil',
            'data' => $user
        ], 200);
    }

}
