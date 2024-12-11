<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Jobs\UpdateExpiredSubscriptions;
use App\Models\QuestionPackage;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        $user = Auth::user();

        if ($user->role === 'user') {

            $queryNews = QuestionPackage::with(['tags', 'author'])->where('public', true);
            $queryNews->orderBy('created_at', 'desc'); // Sắp xếp theo ngày tạo
            $packages = $queryNews->paginate(4);

            // Truy vấn dữ liệu cho popular packages

            $tags = Tag::all();

            $packagesPopular = QuestionPackage::with(['tags', 'author'])
                ->where('public', true)
                ->orderBy('attempt_count', 'desc')
                ->limit(16)
                ->get();  // Lấy dữ liệu thực sự từ cơ sở dữ liệu
            if ($request->ajax()) {
                return view('client.partials.package_cards', compact('packages')); // Trả về view đúng tên phần tử cần hiển thị
            }

            return view('client.pages.homepage', compact('packages', 'packagesPopular', 'tags'));
        } else {
            return redirect('/homepage');
        }
    }

    public function updateAvatar(Request $request)
    {
        // Validate the uploaded file to ensure it's an image
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust max size as needed
        ]);

        // Kiểm tra xem có file hay không
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');


            // Lưu file vào thư mục public/img/avatar
            // You can use storeAs to store the file with a specific name in a storage disk
            if ($file->isValid()) {
                // Tệp hợp lệ, tiến hành lưu
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/avatar'), $filename);
            } else {
                return response()->json(['error' => 'File is not valid.']);
            }


            // Cập nhật tên file vào CSDL (giả sử bạn có một bảng users với trường avatar)
            $user = Auth::user(); // Lấy người dùng đang đăng nhập
            if ($user instanceof User) {
                $user->avatar = $filename;  // Cập nhật trường avatar với tên file mới
                $user->save();  // Lưu lại thay đổi vào CSDL
            }

            // Trả về URL của avatar mới
            return response()->json([
                'success' => true,
                'avatar_url' => asset('img/avatar/' . $filename)  // Correct URL path for storage
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No file uploaded']);
    }
    public function updateUsername(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        $user = Auth::user();

        // Xác minh tên người dùng mới không rỗng
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        // Cập nhật tên người dùng
        if ($user instanceof User) {
            $user->name = $request->username;
            $user->save();
        }
        // Trả về phản hồi thành công
        return response()->json(['success' => true]);
    }
    public function updateBio(Request $request)
    {
        $user = Auth::user(); // Lấy người dùng hiện tại

        // Kiểm tra xem có giá trị 'bio' trong yêu cầu không
        if ($request->has('bio')) {
            $newBio = $request->input('bio');

            // Cập nhật thông tin bio của người dùng
            if ($user instanceof User) {
                $user->bio = $newBio;
                $user->save();
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Không có dữ liệu']);
    }
}
