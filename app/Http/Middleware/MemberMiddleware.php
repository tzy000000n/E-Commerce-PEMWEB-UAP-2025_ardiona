<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberMiddleware
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
            $message = auth()->user()->role === 'admin' 
                ? 'Admin tidak dapat membeli produk. Silakan gunakan akun customer.'
                : 'Seller tidak dapat membeli produk. Silakan gunakan akun customer.';
            
            return redirect()->route('home')->with('error', $message);
        }

        return $next($request);
    }
}
