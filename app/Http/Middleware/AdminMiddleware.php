<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'admin') { // Cek user login dan role admin
            return $next($request);
        }

        // Redirect atau response error jika bukan admin
        return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman admin.'); // Redirect ke halaman home atau halaman lain
        // Atau bisa return abort(403, 'Unauthorized.'); untuk menampilkan halaman error 403
    }
}