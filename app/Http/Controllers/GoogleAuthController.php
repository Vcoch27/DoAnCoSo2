<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    //redirect: chuyển hướng 
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();

            // Tìm người dùng theo google_id
            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                // Nếu không tìm thấy, tìm người dùng theo email
                $user = User::where('email', $google_user->getEmail())->first();

                if ($user) {
                    // Nếu người dùng tồn tại với email đó, cập nhật google_id
                    $user->google_id = $google_user->getId();
                    $user->save();
                } else {
                    // Nếu không tìm thấy người dùng nào, tạo mới
                    $user = User::create([
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId(),
                    ]);
                }
            }

            // Đăng nhập người dùng
            Auth::login($user);
            // return redirect('/');
            return redirect()->route('welcome');
        } catch (\Throwable $th) {
            dd('Something went wrong! ' . $th->getMessage());
        }
    }
}
