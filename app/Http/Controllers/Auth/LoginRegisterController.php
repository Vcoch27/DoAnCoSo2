<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class LoginRegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function register(): View
    {
        return view('auth.login1', ['flag' => 'register']);
    }
    public function login(): View
    {
        return view('auth.login1', ['flag' => 'login']);
    }
}
