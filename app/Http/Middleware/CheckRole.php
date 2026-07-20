<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Membatasi akses route berdasarkan role user yang login.
     * Contoh pemakaian di routes: Route::middleware('role:admin')->group(...)
     *
     * Aturan (sesuai spesifikasi):
     * - Belum login            -> redirect ke halaman Login.
     * - Sudah login tapi role  -> redirect ke dashboard sesuai role user
     *   tidak sesuai              tersebut (bukan 403 mentah), supaya user
     *                              tidak "nyasar" di halaman yang salah.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! in_array($user->role, $roles, true)) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
