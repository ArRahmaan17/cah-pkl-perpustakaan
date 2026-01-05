<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekLogin
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('notif', 'Silakan login dulu');
        }

        return $next($request);
    }
}

