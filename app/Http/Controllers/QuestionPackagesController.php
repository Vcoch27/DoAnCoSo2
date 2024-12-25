<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\PublicRequest;
use App\Models\Question;
use App\Models\QuestionPackage;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserResult;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionPackagesController extends Controller
{
    public function show($id)
    {
        $package = QuestionPackage::findOrFail($id);
        return view('client/pages/packages', compact('package'));
    }

    public function fetchPackages(Request $request)
    {
        $type = $request->input('type', 'new');
        $page = $request->input('page', 1);

        // Lấy gói câu hỏi mới hoặc phổ biến
        $query = QuestionPackage::with(['tags', 'author'])->where('public', true);

        if ($type === 'new') {
            $query->orderBy('created_at', 'desc'); // Sắp xếp theo ngày tạo
        } elseif ($type === 'popular') {
            $query->orderBy('attempt_count', 'desc'); // Sắp xếp theo số lượng tham gia
        }

        // Phân trang
        $packages = $query->paginate(4);

        // Render HTML cho các gói câu hỏi và phân trang
        $html = view('client.partials.package_cards', compact('packages'))->render();
        $pagination = $packages->links('pagination::bootstrap-4')->toHtml();

        return response()->json(['html' => $html, 'pagination' => $pagination, 'type' => $type]);
    }




    public function getQuestionsWithAnswers($packageId)
    {
        if (Auth::check() && (Auth::user()->role === 'user' || Auth::user()->role === 'admin')) {
            session()->put('result_submitted', false);
            $package = QuestionPackage::with(['questions.answers'])->findOrFail($packageId);
            $userPQ = User::find($package->author_id);
            // Chuyển đổi dữ liệu thành JSON có cấu trúc tương thích
            $questions = $package->questions->map(function ($question) {
                // Khởi tạo mảng cho câu trả lời và các câu trả lời đúng
                $answers = [];
                $correctAnswers = [];

                // Duyệt qua tất cả các câu trả lời
                foreach ($question->answers as $index => $answer) {
                    // Tạo key cho câu trả lời
                    $answers['answer_' . chr(97 + $index)] = $answer->answer_text; // chr(97) = 'a', chr(98) = 'b', ...
                    // Tạo key cho câu trả lời đúng
                    $correctAnswers['answer_' . chr(97 + $index)] = $answer->is_correct ? "true" : "false";
                }

                return [
                    'id' => $question->id,
                    'question' => $question->question_text,
                    'answers' => $answers,
                    'correct_answers' => $correctAnswers,
                    'multiple_correct_answers' => count(array_filter($correctAnswers, fn($value) => $value === "true")) > 1 ? "true" : "false", // Kiểm tra xem có nhiều câu trả lời đúng hay không
                    'correct_answer' => collect($question->answers)
                        ->filter(fn($answer) => $answer->is_correct)
                        ->keys()
                        ->first() ?? 'N/A',
                ];
            });

            $jsonData = json_encode($questions);


            return view('client.pages.packages', [
                'package' => $package,
                'jsonData' => $jsonData,
                'userPQ' => $userPQ,

            ]);
        } else {
            session()->flash('message', 'Đây là một thông báo!');
            return redirect('/login ');
        }
    }
    public function submitQuestions(Request $request)
    {

        $questions = session('questions'); // Giả sử danh sách câu hỏi đã lưu trong session
        $userAnswers = $request->all(); // Lấy tất cả câu trả lời từ request
        $score = 0;
        $totalQuestions = count($questions);
        $resultDetails = []; // Mảng chi tiết kết quả cho từng câu hỏi
        $package_title =  $request->input('title_package');
        $package_id = $request->input('id_package');
        $is_public_package = $request->input('is_public_package');
        $userId = Auth::user()->id;



        foreach ($questions as $question) {
            $questionId = $question['id'];
            $correctAnswers = array_filter($question['correct_answers'], fn($correct) => $correct === "true");
            $correctKeys = array_keys($correctAnswers);

            // Lấy câu trả lời của người dùng cho câu hỏi hiện tại
            $userAnswerKeys = $userAnswers[$questionId] ?? ['0']; // Nếu không chọn, lấy giá trị mặc định là ['0']

            // Kiểm tra xem người dùng có chọn đúng các đáp án hay không
            if ($userAnswerKeys === $correctKeys) {
                $score++; // Nếu câu trả lời đúng, tăng điểm
                $resultDetails[] = [
                    'question_id' => $question['id'],
                    'question' => $question['question'],
                    'answer' => $question['answers'],
                    'is_correct' => true,
                    'user_answer' => $userAnswerKeys,
                    'correct_answer' => $correctKeys,
                ];
            } else {
                $resultDetails[] = [
                    'question_id' => $question['id'],
                    'question' => $question['question'],
                    'answer' => $question['answers'],
                    'is_correct' => false,
                    'user_answer' => $userAnswerKeys,
                    'correct_answer' => $correctKeys,
                ];
            }
        }
        $cumulativePoints = $score * 2; // mỗi câu đúng được 2 điểm
        if ($score === $totalQuestions) {
            $cumulativePoints = $totalQuestions * 2 * 1.2; // trường hợp đạt 100% câu đúng
        }

        $new_daily_limit = null;

        // Kiểm tra nếu đã lưu kết quả và cờ tồn tại trong session
        if (!session()->get('result_submitted', true)) {
            // Gói câu hỏi public mới được cộng điểm và lưu trữ bảng ghi
            if ($is_public_package) {
                // cập nhật điểm tích lũy vào bang users
                $user = User::find($userId);
                $user->cumulative += $cumulativePoints;
                $user->save();
                //lưu trữ bảng ghi
                UserResult::create([
                    'user_id' => $userId,
                    'question_package_id' => $package_id,
                    'cumulative_points' => $cumulativePoints,
                    'percent' => round(($score / $totalQuestions) * 100, 2),
                    'user_choices' => json_encode($resultDetails),
                    'completed_at' => now(),
                ]);


                $package = QuestionPackage::find($package_id);

                if ($package) {
                    // Tăng giá trị của thuộc tính attempt_count lên 1
                    $package->attempt_count += 1;
                    $package->save();
                }
                // giảm heart
                if (!Auth::user()->isPremium) {
                    if (!$user->is_premium) {
                        $user->decrementDailyLimit();
                        $user->save();
                        $new_daily_limit = $user->daily_limit;
                    }
                }
                $cumulativePoints = -1;
            } else {
            }
            session()->put('result_submitted', true);
        }


        // Tính kết quả tổng thể
        return view('client.pages.packages_result', compact('score', 'questions', 'totalQuestions', 'resultDetails', 'package_title', 'package_id', 'cumulativePoints', 'new_daily_limit'));
    }
    //tạo gói câu hỏi
    public function create(Request $request)
    {
        $tags = Tag::all();
        return view('client/pages/add_package', compact('tags'));
    }


    public function storeTest(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'array',
            'questions' => 'required|array', // Kiểm tra mảng câu hỏi
        ]);
        // Lấy toàn bộ dữ liệu từ request dạng JSON
        $jsonRequest = $validated['questions'];

        // Chuyển đến view cùng với dữ liệu
        return view('client.test', compact('jsonRequest'));
    }


    public function store(Request $request)
    {

        // Làm sạch và kiểm tra tags
        $testValue = json_encode($request->all());

        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'array',
            'questions' => 'required|array', // Kiểm tra mảng câu hỏi


        ]);
        $tags = array_values(array_filter($validated['tags'], function ($tag) {
            return !is_null($tag);
        }));


        DB::beginTransaction(); // Bắt đầu transaction

        try {
            $questionPackage = QuestionPackage::create([
                'title' => $validated['title'],
                'author_id' => Auth::id(), // Đảm bảo người dùng đã đăng nhập
                'description' => $validated['description'],
                'public' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);



            foreach ($tags as $tagId) {
                // Kiểm tra xem tagId có tồn tại trong bảng tags
                $tagExists = DB::table('tags')->where('id', $tagId)->exists();

                if ($tagExists) {
                    DB::table('package_tag')->insert([
                        'package_id' => $questionPackage->id,
                        'tag_id' => $tagId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    logger("Tag with ID {$tagId} does not exist.");
                }
            }


            $createdQuestions = [];

            // Tạo các câu hỏi và câu trả lời liên quan
            foreach ($validated['questions'] as $questionData) {
                // Kiểm tra xem câu hỏi đã tồn tại trong gói câu hỏi này chưa
                $existingQuestion = Question::where('question_package_id', $questionPackage->id)
                    ->where('question_text', $questionData['question_text'])
                    ->first();

                if ($existingQuestion) {
                    // Nếu câu hỏi đã tồn tại, có thể bỏ qua hoặc cập nhật câu hỏi, tuỳ thuộc vào yêu cầu của bạn
                    continue;  // Bỏ qua câu hỏi này
                } else {
                    // Nếu câu hỏi chưa tồn tại, tạo mới câu hỏi
                    $question = Question::create([
                        'question_package_id' => $questionPackage->id,
                        'question_text' => $questionData['question_text'],
                    ]);

                    // Tạo các câu trả lời cho mỗi câu hỏi
                    foreach ($questionData['answers'] as $answerData) {
                        // Kiểm tra xem câu trả lời có trường 'is_correct' hay không
                        $isCorrect = isset($answerData['is_correct']) && $answerData['is_correct'] === 'on' ? true : false;

                        Answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $answerData['answer_text'],
                            'is_correct' => $isCorrect,  // Gán giá trị đúng/sai
                        ]);
                    }

                    // Lưu câu hỏi đã tạo
                    $createdQuestions[] = $question;
                }
            }

            //đăng kí gói public 
            if ($request->has('register_public') && $request->input('register_public') == 'on') {
                PublicRequest::create([
                    'package_id' => $questionPackage->id,
                    'requested_by' => Auth::user()->id,
                    'status' => 'pending',
                ]);
            }


            DB::commit(); // Commit transaction nếu thành công

            session()->flash('notifications', [
                [
                    'type' => 'success', // success, error, info, warning
                    'message' => 'Add question package successfully!',
                    'subtext' => 'Your data has been saved.'
                ]
            ]);
            return Redirect::back()->with('testValue', $testValue);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction nếu có lỗi


            session()->flash('notifications', [
                [
                    'type' => 'error', // success, error, info, warning
                    'message' => 'Add question pack failed!',
                    'subtext' => 'Trying again.'
                ]
            ]);
            // Chuyển đến view cùng với dữ liệu JSON
            return Redirect::back();
        }
    }

    public function edit(Request $request, $id)
    {
        $questionPackage = QuestionPackage::with('tags')->findOrFail($id);

        if ($questionPackage->author_id !==  Auth::user()->id) {
            abort(403, 'You are not authorized to edit this package.');
        }

        // Lấy danh sách tags
        $tags = Tag::all();

        // Lấy các câu hỏi và câu trả lời liên quan đến gói
        $questions = [
            'questions' => Question::with('answers')->where('question_package_id', $id)->get()
        ];

        // Truyền dữ liệu đến view
        return view('client/pages/edit_package', compact('questionPackage', 'tags', 'questions'));
    }
    public function update(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'array',
            'questions' => 'required|array', // Kiểm tra mảng câu hỏi
        ]);

        // Làm sạch tags
        $tags = array_values(array_filter($validated['tags'], function ($tag) {
            return !is_null($tag);
        }));

        DB::beginTransaction(); // Bắt đầu transaction
        try {
            // Tìm gói câu hỏi
            $questionPackage = QuestionPackage::findOrFail($id);

            // Cập nhật thông tin cơ bản của gói câu hỏi
            $questionPackage->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'updated_at' => now(),
                'public' => false,

            ]);

            // Đồng bộ tags
            $questionPackage->tags()->sync($tags);

            // Xóa các câu hỏi không có trong dữ liệu gửi lên
            $existingQuestionsIds = collect($validated['questions'])->pluck('id')->filter()->toArray();
            $questionPackage->questions()->whereNotIn('id', $existingQuestionsIds)->delete();

            // Xử lý câu hỏi và câu trả lời
            foreach ($validated['questions'] as $questionData) {
                if (isset($questionData['id'])) {
                    // Cập nhật câu hỏi nếu đã tồn tại
                    $question = Question::findOrFail($questionData['id']);
                    $question->update([
                        'question_text' => $questionData['question_text'],
                    ]);

                    // Đồng bộ câu trả lời
                    foreach ($questionData['answers'] as $answerData) {
                        if (isset($answerData['id'])) {
                            // Cập nhật câu trả lời nếu đã tồn tại
                            $answer = Answer::findOrFail($answerData['id']);
                            $answer->update([
                                'answer_text' => $answerData['answer_text'],
                                'is_correct' => isset($answerData['is_correct']) && $answerData['is_correct'] === 'on',
                            ]);
                        } else {
                            // Tạo mới câu trả lời
                            Answer::create([
                                'question_id' => $question->id,
                                'answer_text' => $answerData['answer_text'],
                                'is_correct' => isset($answerData['is_correct']) && $answerData['is_correct'] === 'on',
                            ]);
                        }
                    }
                } else {
                    // Tạo mới câu hỏi nếu chưa tồn tại
                    $newQuestion = Question::create([
                        'question_package_id' => $questionPackage->id,
                        'question_text' => $questionData['question_text'],
                    ]);

                    // Tạo các câu trả lời cho câu hỏi mới
                    foreach ($questionData['answers'] as $answerData) {
                        Answer::create([
                            'question_id' => $newQuestion->id,
                            'answer_text' => $answerData['answer_text'],
                            'is_correct' => isset($answerData['is_correct']) && $answerData['is_correct'] === 'on',
                        ]);
                    }
                }
            }

            if ($request->has('register_public') && $request->input('register_public') == 'on') {
                // Kiểm tra xem đã tồn tại PublicRequest với package_id, requested_by và status 'pending' chưa
                $existingRequest = PublicRequest::where('package_id', $questionPackage->id)
                    ->where('requested_by', Auth::user()->id)
                    ->where('status', 'pending')
                    ->first();

                // Nếu không có bản ghi nào tồn tại thì tạo mới
                if (!$existingRequest) {
                    PublicRequest::create([
                        'package_id' => $questionPackage->id,
                        'requested_by' => Auth::user()->id,
                        'status' => 'pending',
                    ]);
                }
            }


            DB::commit(); // Commit transaction
            session(['validated_data' => $validated]);
            session()->flash('notifications', [
                [
                    'type' => 'success',
                    'message' => 'Update question package successfully!',
                    'subtext' => 'Your changes have been saved.',
                ]
            ]);

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction nếu có lỗi

            session()->flash('notifications', [
                [
                    'type' => 'error',
                    'message' => 'Update question package failed!',
                    'subtext' => 'Please try again.',
                ]
            ]);
        }
    }
    public function getTagPackages($tagId)
    {
        // Lấy các gói câu hỏi liên quan đến tag
        // $packages = QuestionPackage::where('id', $tagId)->get();
        $packages = QuestionPackage::with(['tags', 'author'])
            ->whereHas('tags', function ($query) use ($tagId) {
                $query->where('tags.id', $tagId);  // Tìm các gói câu hỏi có tag_id tương ứng
            })
            ->where('public', true)  // Nếu cần lọc theo điều kiện 'public'
            ->get();
        // Lấy tên tag
        $tagName = Tag::find($tagId)->name;

        // Lấy số lượng gói câu hỏi
        $packagesCount = $packages->count();
        // Render view và trả về HTML
        $html = view('client.partials.search-content', compact('packages', 'tagName', 'packagesCount'))->render();

        return response()->json(['html' => $html]); // Trả về HTML dưới dạng JSON
    }
    public function searchPackages(Request $request)
    {
        $query = $request->input('query');

        $packages = QuestionPackage::with(['tags', 'author'])
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%");
            })
            ->orWhereHas('tags', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhereHas('author', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->where('public', true)
            ->orderBy('title', 'asc') // Sắp xếp theo tiêu đề
            ->get();

        $packagesCount = $packages->count();
        // Trả về view với HTML được render sẵn
        $html = view('client.partials.search-content', compact('packages', 'packagesCount', 'query'))->render();

        return response()->json(['html' => $html]);
    }
}
