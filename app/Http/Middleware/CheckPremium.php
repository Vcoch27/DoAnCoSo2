<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; // Thêm facade Auth
use App\Models\User;
use Illuminate\Http\Request;

class CheckPremium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (($user && $user->hasActivePremium())) {
            return $next($request);
        }

        return redirect()->route('premium.upgrade');
    }
}
