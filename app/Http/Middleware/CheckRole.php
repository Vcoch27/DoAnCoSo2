<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; // Thêm facade Auth

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect('/dashboard');
            } else if (Auth::user()->role === 'user') {
                return redirect('/homepage');
            }
        }
        return $next($request);
    }
}
