<?php

namespace App\Http\Controllers;

use App\Models\DoorLog;
use App\Models\Reader;
use Illuminate\Http\Request;

class AdminDoor extends Controller
{
    public function index()
    {
        $readers = Reader::all();

        $logs = DoorLog::with(['reader', 'user'])
            ->latest()
            ->paginate(10);

        return view('dashboard_admin.doorlog', compact('readers', 'logs'));
    }
}
