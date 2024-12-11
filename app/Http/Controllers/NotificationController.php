<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function fetchNotifications(Request $request)
    {
        $user = Auth::user();
        $page = $request->input('page', 1); // Lấy số trang từ request, mặc định là trang 1
        $perPage = 10; // Số lượng thông báo mỗi trang

        // Lấy thông báo của người dùng với phân trang
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'status' => 'success',
            'data' => $notifications->items(),  // Trả về dữ liệu thông báo
        ]);
    }
}
