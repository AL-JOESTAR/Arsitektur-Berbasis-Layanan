<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardRedirectController extends Controller
{
    public function __invoke()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        
        if ($user->name === 'Administrator' || $user->email === 'admin') {
            return view('dashboard.dashboard'); 
        }

        if($user->status_user == 'active'){
            return view('dashboard.dashboard');
        }

        return redirect()->route('home');
    }
}
