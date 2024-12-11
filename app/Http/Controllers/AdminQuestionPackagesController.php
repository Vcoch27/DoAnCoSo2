<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionPackage;
use Illuminate\Http\Request;

class AdminQuestionPackagesController extends Controller
{
    public function index(Request $request)
    {
        // Set default sort field and order
        $sortField = $request->get('sort_field', 'title'); // Default sort by 'title'
        $sortOrder = $request->get('sort_order', 'asc');   // Default order is ascending

        // Apply sorting to the query
        $packages = QuestionPackage::with('author')
            // ->orderBy($sortField, $sortOrder) // Dynamic sorting based on the field and order
            ->paginate(15);

        // Return the view with the packages and sorting parameters
        return view('admin/pages/table_question_packages', compact('packages', 'sortField', 'sortOrder'));
    }
    public function getPackageDetails(Request $request)
    {
        $packageId = $request->input('package_id');
        $questionPackage = QuestionPackage::with('tags')->findOrFail($packageId);
        $questions = Question::with('answers')->where('question_package_id', $packageId)->get();

        $html = view('admin/partials/package-details-overlay', compact('questionPackage', 'questions'))->render();

        // Kiểm tra dữ liệu trả về
        return response()->json([
            'package_id' => $packageId,
            'html' => $html
        ]);
    }
    public function deletePackage($id)
    {
        try {
            // Tìm gói câu hỏi theo ID
            $package = QuestionPackage::findOrFail($id);

            // Xóa gói câu hỏi
            $package->delete();

            // Trả về thông báo thành công
            return response()->json(['message' => 'Package deleted successfully.']);
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, trả về thông báo lỗi
            return response()->json(['message' => 'Failed to delete the package.'], 500);
        }
    }
    public function updateMode($id)
    {
        $package = QuestionPackage::find($id);
        if (!$package) {
            return response()->json(['message' => 'Package not found.'], 404);
        }

        $package->public = !$package->public;
        $package->save();
        return response()->json(['message' => 'Public mode updated successfully.']);
    }
}
