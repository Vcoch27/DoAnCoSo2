<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\PublicRequest;
use App\Models\Question;
use App\Models\QuestionPackage;
use Illuminate\Http\Request;

class AdminPublicRequestsController extends Controller
{
    public function index(Request $request)
    {
        // Lọc theo status, mặc định là 'pending'
        $status = $request->get('status', 'pending');

        // Lấy dữ liệu từ PublicRequest kèm theo thông tin liên kết với QuestionPackage và User
        $requests = PublicRequest::with(['package', 'user'])
            ->where('status', $status)
            ->paginate(15); // Phân trang 15 bản ghi mỗi trang

        return view('admin/pages/public_requests', compact('requests'));
    }

    public function getPackageDetails(Request $request)
    {
        $packageId = $request->input('package_id');
        $questionPackage = QuestionPackage::with('tags')->findOrFail($packageId);
        $questions = Question::with('answers')->where('question_package_id', $packageId)->get();

        $html = view('admin/partials/package-details', compact('questionPackage', 'questions'))->render();

        // Kiểm tra dữ liệu trả về
        return response()->json([
            'package_id' => $packageId,
            'html' => $html
        ]);
    }
    public function approve(Request $request, $id)
    {
        // Tìm gói câu hỏi
        $requestPublic = PublicRequest::findOrFail($id);

        // Cập nhật trạng thái public
        $requestPublic->update([
            'status' => 'approved',
        ]);

        // Tạo thông báo
        Notification::create([
            'user_id' => $requestPublic->requested_by, // Người yêu cầu
            'title' => 'Package Approved',
            'message' => 'Your question package has been approved for public use.',
            'type' => 'success',
        ]);

        return response()->json([
            'message' => 'The package with ID ' . $requestPublic->package_id . ' has been approved successfully.',
        ]);
    }
    public function reject(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'rejection_message' => 'nullable|string|max:255',
        ]);

        // Tìm gói câu hỏi
        $questionPackage = PublicRequest::findOrFail($id);

        // Cập nhật trạng thái public
        $questionPackage->update([
            'status' => 'rejected',
        ]);

        // Check if requested_by is not null
        if ($questionPackage->requested_by) {
            Notification::create([
                'user_id' => $questionPackage->requested_by,
                'title' => 'Package Rejected',
                'message' => $request->input('rejection_message') . '  Your question package has been rejected.',
                'type' => 'error',
            ]);
        } else {
            return response()->json([
                'message' => 'Requested user not found for notification.',
            ], 400);
        }


        return response()->json([
            'message' => 'The package has been rejected successfully.',
        ]);
    }
}
