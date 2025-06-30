<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AssessorOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah user adalah assessor (role_id = 2 berdasarkan LoginController)
        if (Auth::user()->role_id != 2) {
            return redirect('/login')->with('error', 'Akses ditolak. Anda tidak memiliki izin assessor');
        }

        return $next($request);
    }
}
