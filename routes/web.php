<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPremiumController;
use App\Http\Controllers\AdminPublicRequestsController;
use App\Http\Controllers\AdminQuestionPackagesController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionPackagesController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckPremium;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

//------------
// Route::get('/packages/create', [QuestionPackagesController::class, 'viewCreatePackages'])
//     ->name('create.packages');
// ------------------------- User Routes -------------------------
Route::get('/homepage', [UserController::class, 'index'])->name('homepage');
Route::get('/packages', [QuestionPackagesController::class, 'fetchPackages'])->name('packages.fetch');
Route::get('/notifications', [NotificationController::class, 'fetchNotifications'])->name('notifications.fetch');


// User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/editprofile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Avatar and Bio Update
Route::post('/update-avatar', [UserController::class, 'updateAvatar'])->name('update-avatar');
Route::post('/update-username', [UserController::class, 'updateUsername'])->name('update.username');
Route::post('/update-bio', [UserController::class, 'updateBio'])->name('updateBio');

// ------------------------- Admin Routes -------------------------
Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Admin Package Routes
Route::get('/dashboard/packages', [AdminQuestionPackagesController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.packages');
Route::post('/packages/{id}/approve', [AdminPublicRequestsController::class, 'approve'])->name('packages.approve');
Route::post('/packages/{id}/reject', [AdminPublicRequestsController::class, 'reject'])->name('packages.reject');
Route::post('/get-package-details-overlay', [AdminQuestionPackagesController::class, 'getPackageDetails'])->name('get-package-details-overlay');
Route::post('/delete-package/{id}', [AdminQuestionPackagesController::class, 'deletePackage'])->name('package.delete');
Route::post('/update-public-mode/{id}', [AdminQuestionPackagesController::class, 'updateMode']);
// Admin Premium Routes
Route::get('/dashboard/premium', [AdminPremiumController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.premium');

// Admin Public Request Routes
Route::get('/dashboard/public_requests', [AdminPublicRequestsController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.public_requests');
Route::post('/get-package-details', [AdminPublicRequestsController::class, 'getPackageDetails'])->name('get-package-details');

// Admin User Routes
Route::get('/dashboard/tables', [AdminUserController::class, 'index'])->middleware(['auth', 'verified'])->name('tables');
Route::put('/users/{user}/block', [AdminUserController::class, 'block'])->name('users.block');
Route::post('/users/unblock-account/{userId}', [AdminUserController::class, 'unblockAccount']);
Route::get('/users/sort', [AdminUserController::class, 'sortUsers']);
// ------------------------- Question Package Routes -------------------------
Route::get('/packages/create', [QuestionPackagesController::class, 'create'])->name('packages.create');
Route::post('/packages/store', [QuestionPackagesController::class, 'store'])->name('packages.store');
Route::get('/packages/{id}', [QuestionPackagesController::class, 'getQuestionsWithAnswers'])->name('packages.show');
Route::get('/packages/{id}/edit', [QuestionPackagesController::class, 'edit'])->name('packages.edit');
Route::put('/packages/{id}/update', [QuestionPackagesController::class, 'update'])->name('packages.update');
Route::post('/submit-questions', [QuestionPackagesController::class, 'submitQuestions'])->name('submit.questions');
Route::get('/get-packages/{tagId}', [QuestionPackagesController::class, 'getTagPackages']);
Route::get('/search-packages', [QuestionPackagesController::class, 'searchPackages']);

// ------------------------- Payment Routes -------------------------
Route::get('/premium', [PaymentController::class, 'showPremium'])->name('premium');
Route::get('/premium/upgrade', [PaymentController::class, 'index'])->name('premium.upgrade');
Route::post('/premium', [PaymentController::class, 'pay'])->name('premium.pay');
Route::any('/callback-payment', [PaymentController::class, 'callbackPayment'])->name('callback.payment');
Route::any('/order-status', [PaymentController::class, 'orderStatus'])->name('orderstatus.payment');

// ------------------------- Google Auth Routes -------------------------
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

// ------------------------- Miscellaneous Routes -------------------------
Route::get('/test', [TestController::class, 'index'])->name('test');
Route::post('/send-email', [MailController::class, 'sendEmail'])->name('send.email');

// ------------------------- Welcome Route -------------------------
Route::get('/', function () {
    return view('welcome1');
})->name('welcome')->middleware([CheckRole::class]);




require __DIR__ . '/auth.php';
