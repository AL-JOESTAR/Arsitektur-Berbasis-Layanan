<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ParentAuthController extends Controller
{
     public function create()
    {
        return view('parent.login');
    }

    public function store(Request $request)
    {

        $request->validate([

            'email'=>'required|email',
            'password'=>'required'

        ]);

        if(Auth::guard('parent')->attempt([

            'email'=>$request->email,
            'password'=>$request->password

        ])){

            $request->session()->regenerate();

            return redirect()->route('parent.dashboard');

        }

        return back()->withErrors([

            'email'=>'Email atau password salah.'

        ]);

    }

    public function destroy(Request $request)
    {

        Auth::guard('parent')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/parent/login');

    }
}
