<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        if (auth()->user()->role !== 'member') {
            abort(403, 'Akses ditolak. Anda harus menjadi member untuk mengakses halaman ini.');
        }

        // Cek apakah user memiliki toko
        if (!auth()->user()->store) {
            return redirect()->route('store.register')->with('error', 'Anda harus mendaftar sebagai penjual terlebih dahulu');
        }

        return $next($request);
    }
}
