<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PenyewaMiddlerware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if ($user->role !== 'penyewa') {
            abort(403);
        }

        if ($user->status_user !== 'active') {
            return redirect()->route('home')
                ->with('error', 'Akun Anda belum aktif.');
        }

    return $next($request);
    }
}
