<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('gagal', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role_id !== 1) {
            return redirect('/')->with('gagal', 'Kamu tidak memiliki akses.');
        }

        return $next($request);
    }
}
