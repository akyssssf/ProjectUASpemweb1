<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login sebagai staff
        if (!Auth::guard('staff')->check()) {
            return redirect('/petugas/login');
        }

        // 2. Ambil role user
        $userRole = Auth::guard('staff')->user()->role;

        // 3. Cek apakah role user ada dalam daftar yang diizinkan (admin, dsb)
        if (!in_array($userRole, $roles)) {
            return redirect('/petugas/monitoring');
        }

        return $next($request);
    }
}