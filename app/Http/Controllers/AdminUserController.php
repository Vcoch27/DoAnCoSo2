<?php

namespace App\Http\Controllers;

use App\Mail\AccountBlockedNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminUserController extends Controller
{


    public function index(Request $request)
    {
        // Lấy giá trị tìm kiếm từ yêu cầu (mặc định là rỗng)
        $searchValue = $request->input('search', ''); // Giá trị tìm kiếm
        $searchField = $request->input('search_field', 'all'); // Trường tìm kiếm (mặc định là 'all')

        // Xây dựng truy vấn cho người dùng
        $query = User::query();

        // Điều kiện tìm kiếm theo trường và giá trị
        if ($searchField === 'name' && $searchValue) {
            $query->where('name', 'like', '%' . $searchValue . '%');
        } elseif ($searchField === 'email' && $searchValue) {
            $query->where('email', 'like', '%' . $searchValue . '%');
        } elseif ($searchField === 'all' && $searchValue) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }

        // Lấy người dùng kèm với số lượng questionPackages, sử dụng phân trang
        $users = $query->withCount('questionPackages')->paginate(10);
        // Số lượng kết quả tìm được
        $searchCount = $users->total(); // Tổng số bản ghi
        // Nếu yêu cầu là AJAX (tìm kiếm), trả về dữ liệu JSON
        if ($request->ajax()) {
            return view('admin.includes.user_table', compact('users', 'searchCount'))->render();
        }

        // Trả về view với dữ liệu
        return view('admin.pages.tables', compact('users'));
    }
    public function block(User $user)
    {
        // Kiểm tra nếu người dùng chưa bị chặn
        if (!$user->is_blocked) {
            $user->update(['is_blocked' => true]);
            return response()->json(['message' => 'Account has been blocked'], 200);
        }
        $blockDate = now();
        Mail::to($user->email)->send(new AccountBlockedNotification($user, $blockDate));
        return response()->json(['message' => 'This account is already blocked'], 400);
    }
    // Phương thức unblock account
    public function unblockAccount($userId)
    {
        $user = User::findOrFail($userId);
        $user->is_blocked = false;
        $user->save();

        return response()->json(['success' => true]);
    }
    public function sortUsers(Request $request)
    {
        $column = $request->input('column');
        $order = $request->input('order', 'asc');

        $users = User::orderBy($column, $order)->withCount('questionPackages')->get();
        return view('admin.includes.user_table', compact('users'))->render();
    }
}
