<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionExpiredRedirect
{
    public function handle($request, Closure $next)
    {
        // kalau user belum login (session expired)
        if (!Auth::check()) {
            return redirect('/admin_login')
                ->with('error', 'Sesi kamu telah berakhir, silakan login kembali.');
        }

        return $next($request);
    }
}
