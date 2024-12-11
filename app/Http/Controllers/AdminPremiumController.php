<?php

namespace App\Http\Controllers;

use App\Models\UserPremiumSubscription;
use Illuminate\Http\Request;

class AdminPremiumController extends Controller
{
    public function index(Request $request)
    {
        // Lấy dữ liệu từ UserPremiumSubscription kèm theo thông tin liên kết với User và PremiumPlan
        $subscriptions = UserPremiumSubscription::with(['user', 'premiumPlan'])
            ->paginate(15); // Phân trang 15 bản ghi mỗi trang

        return view('admin.pages.user_premium_subscriptions', compact('subscriptions'));
    }
}
