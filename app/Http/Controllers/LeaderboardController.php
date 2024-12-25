<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Lấy danh sách top 15 người dùng (loại bỏ những người có điểm bằng 0)
        $topUsers = User::where('cumulative', '>', 0)
            ->orderBy('cumulative', 'desc')
            ->take(15)
            ->get();

        $currentUser = Auth::user();
        if ($currentUser->cumulative == 0) {
            $currentUserRank = 0;
        } else {
            $currentUserRank = User::where('cumulative', '>', 0)
                ->where('cumulative', '>', $currentUser->cumulative)
                ->count() + 1;
        }
        return view('client/pages/leaderboard', compact('topUsers', 'currentUser', 'currentUserRank'));
    }
}
