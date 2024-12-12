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
            ->orderByRaw("
                CASE 
                    WHEN status = 'pending' THEN 1
                    WHEN status = 'active' THEN 2
                    WHEN status = 'expired' THEN 3
                    ELSE 4
                END
            ")
            ->paginate(15);

        return view('admin.pages.user_premium_subscriptions', compact('subscriptions'));
    }
}
