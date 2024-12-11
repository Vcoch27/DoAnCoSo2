<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\QuestionPackage;
use App\Models\User;
use App\Models\UserResult;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function show($id)
    {
        // Tìm kiếm người dùng có ID trùng với ID trong database
        $user = User::where('id', $id)->first();
        // Nếu không tìm thấy người dùng 
        if (!$user) {
            abort(403, 'Người dùng không tồn tại');
        }
        $isOwner = Auth::check() && Auth::id() === $user->id;
        $packages = QuestionPackage::where('author_id', operator: $id)->with('tags')->get();

        $publicPackages = QuestionPackage::where('public', true)
            ->where('author_id', $id)
            ->with('tags')
            ->get();

        $nonPublicPackages = QuestionPackage::where('public', false)
            ->where('author_id', $id)
            ->with('tags')
            ->get();

        $history = UserResult::with('questionPackage')
            ->where('user_id', $user->id)
            ->orderBy('completed_at', 'desc')
            ->paginate(7) // Phân trang 7 bản ghi mỗi trang
            ->through(function ($result) {
                return [
                    'id_package' => $result->questionPackage->id,
                    'title' => $result->questionPackage->title,
                    'percent' => $result->percent . '%',
                    'points' => $result->cumulative_points, // Điểm đạt được
                    'completed_at' => Carbon::parse($result->completed_at)->diffForHumans(),
                ];
            });

        // Nếu tìm thấy người dùng và đúng ID, hiển thị profile
        return view('client.pages.profile', compact('user', 'isOwner', 'publicPackages', 'nonPublicPackages', 'history'));
    }





    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
