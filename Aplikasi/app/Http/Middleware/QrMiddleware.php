<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class QrMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check()){
            return redirect('login');
        }

        $user = auth::user();

        if($user->name !== 'Admin' && $user->email !== 'admin@admin.com'){
            abort(404);
        }

        return $next($request);
    }
}
