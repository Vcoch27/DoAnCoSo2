<?php

namespace App\Http\Controllers;

use App\Models\PublicRequest;
use App\Models\QuestionPackage;
use App\Models\User;
use App\Models\UserPremiumSubscription;
use App\Models\UserResult;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Số gói câu hỏi
        $totalQuestionPackages = QuestionPackage::count();
        $totalPublicQuestionPackages = QuestionPackage::where('public', true)->count();

        // Tỷ lệ tăng so với tuần trước (giả sử bạn có thể tính toán bằng cách so sánh số lượng từ tuần trước)
        $lastWeekTotalPublicQuestionPackages = QuestionPackage::where('public', true)
            ->where('created_at', '>=', now()->subWeek())
            ->count();
        $publicPackageGrowthRate = $lastWeekTotalPublicQuestionPackages > 0
            ? ($totalPublicQuestionPackages - $lastWeekTotalPublicQuestionPackages) / $lastWeekTotalPublicQuestionPackages * 100
            : 0;

        // 2. Tổng số người dùng và số người dùng mới tuần qua
        $totalUsers = User::count();
        $newUsersLastWeek = User::where('created_at', '>=', now()->subWeek())->count();
        $userGrowthRate = $newUsersLastWeek > 0
            ? ($totalUsers - ($totalUsers - $newUsersLastWeek)) / $newUsersLastWeek * 100
            : 0;

        // 3. Số lượng thực hiện gói câu hỏi và tỷ lệ tăng
        $totalUserResults = UserResult::count();
        $userResultsToday = UserResult::whereDate('created_at', today())->count();
        $userResultsYesterday = UserResult::whereDate('created_at', today()->subDay())->count();
        $userResultsGrowthRate = $userResultsYesterday > 0
            ? ($userResultsToday - $userResultsYesterday) / $userResultsYesterday * 100
            : 0;

        // 4. Tổng doanh thu từ việc đăng kí premium
        $totalPremiumUser = User::where('is_premium', 1)->count();

        $totalPremiumRevenue = UserPremiumSubscription::where('status', 'expired')
            ->orWhere('status', 'active')
            ->sum('amount');

        // Doanh thu của tuần trước
        $premiumRevenueLastWeek = UserPremiumSubscription::where(function ($query) {
            $query->where('status', 'expired')
                ->orWhere('status', 'active');
        })
            ->where('updated_at', '>=', now()->subWeek())
            ->sum('amount');

        // Tỷ lệ tăng trưởng doanh thu từ tuần trước
        $premiumRevenueGrowthRate = $premiumRevenueLastWeek > 0
            ? ($totalPremiumRevenue - $premiumRevenueLastWeek) / $premiumRevenueLastWeek * 100
            : 0;

        $pendingPublicRequests = PublicRequest::where('status', 'pending')->count();
        $pendingPremiumSubscriptions = UserPremiumSubscription::where('status', 'pending')->count();

        $activePage = 'dashboard';
        // Trả về view với dữ liệu
        return view('admin/pages/dashboard', compact(
            'totalQuestionPackages',
            'totalPublicQuestionPackages',
            'lastWeekTotalPublicQuestionPackages',
            'publicPackageGrowthRate',
            'totalUsers',
            'newUsersLastWeek',
            'userGrowthRate',
            'totalUserResults',
            'userResultsToday',
            'userResultsGrowthRate',
            'totalPremiumRevenue',
            'premiumRevenueLastWeek',
            'premiumRevenueGrowthRate',
            'totalPremiumUser',
            'pendingPublicRequests',
            'activePage',
            'pendingPremiumSubscriptions'
        ));
    }
}
