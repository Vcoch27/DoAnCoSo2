<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng đã đăng nhập và bị chặn
        if (Auth::check() && Auth::user()->is_blocked) {
            Auth::logout(); // Đăng xuất nếu bị chặn
            session()->flash('alert', 'Your account is blocked. Please contact support.');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
