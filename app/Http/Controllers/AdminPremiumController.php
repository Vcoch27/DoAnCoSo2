<?php

namespace App\Http\Controllers;

use App\Models\PremiumPlan;
use App\Models\UserPremiumSubscription;
use Carbon\Carbon;
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

    // Phương thức để kích hoạt subscription
    public function activate($id)
    {
        $subscription = UserPremiumSubscription::find($id);

        // Kiểm tra subscription có tồn tại và status là 'pending'
        if ($subscription && $subscription->status === 'pending') {
            // Lấy thông tin duration từ bảng premium_plans
            $premiumPlan = PremiumPlan::find($subscription->premium_plan_id);
            $duration = $premiumPlan ? $premiumPlan->duration : 0;

            // Cập nhật ngày bắt đầu và ngày kết thúc
            $subscription->status = 'active';
            $subscription->start_date = Carbon::today();
            $subscription->end_date = Carbon::today()->addDays($duration);
            $subscription->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Subscription not found or status is not pending']);
    }

    // Phương thức để xóa subscription
    public function delete($id)
    {
        $subscription = UserPremiumSubscription::find($id);

        // Kiểm tra subscription có tồn tại
        if ($subscription) {
            $subscription->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Subscription not found']);
    }

    public function updateSubscription(Request $request)
    {
        // Xác thực đầu vào
        $validated = $request->validate([
            'appTransId' => 'required|exists:subscriptions,appTransId',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        // Cập nhật dữ liệu
        $subscription = UserPremiumSubscription::where('appTransId', $request->appTransId)->first();

        if ($subscription) {
            $subscription->startDate = $request->startDate;
            $subscription->endDate = $request->endDate;
            $subscription->save();

            return response()->json(['success' => true, 'message' => 'Subscription updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Subscription not found']);
    }

    // Xóa subscription
    public function deleteSubscription(Request $request)
    {
        // Xác thực đầu vào
        $validated = $request->validate([
            'appTransId' => 'required|exists:subscriptions,appTransId',
        ]);

        // Xóa dữ liệu
        $subscription = UserPremiumSubscription::where('appTransId', $request->appTransId)->first();

        if ($subscription) {
            $subscription->delete();
            return response()->json(['success' => true, 'message' => 'Subscription deleted successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Subscription not found']);
    }
}
