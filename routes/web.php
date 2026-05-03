<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/services', [\App\Http\Controllers\PageController::class, 'services'])->name('services');
Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/terms', [\App\Http\Controllers\PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [\App\Http\Controllers\PageController::class, 'privacy'])->name('privacy');
Route::get('/hire', [\App\Http\Controllers\PageController::class, 'hireCars'])->name('cars.hire');
Route::get('/contact', [\App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\PageController::class, 'submitContact'])->name('contact.submit');

Route::get('/cars/{slug}', [CarController::class, 'show'])->name('cars.show');
Route::post('/cars/{car}/inquiries', [CarController::class, 'storeInquiry'])->name('inquiries.store');

// Car Reservation + M-Pesa
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/cars/{car}/reserve', [ReservationController::class, 'store'])->name('cars.reserve');
    Route::get('/reservations/{reservation}/status', [ReservationController::class, 'checkStatus'])->name('reservations.status');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', fn () => view('auth.login'))->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/register', fn () => view('auth.register'))->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

// Password Reset Routes
Route::get('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [\App\Http\Controllers\PasswordResetController::class, 'edit'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [\App\Http\Controllers\PasswordResetController::class, 'update'])
    ->middleware('guest')
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Routes
    Route::get('/profile', [\App\Http\Controllers\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
    
    // Settings Routes
    Route::get('/settings', [\App\Http\Controllers\User\ProfileController::class, 'settings'])->name('settings');
    Route::patch('/settings/password', [\App\Http\Controllers\User\ProfileController::class, 'updatePassword'])->name('settings.password');
    
    // Avatar Deletion
    Route::delete('/profile/avatar', [\App\Http\Controllers\User\ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');
});

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Cars Management
    Route::resource('cars', AdminCarController::class);
    Route::post('/cars/{car}/toggle-featured', [AdminCarController::class, 'toggleFeatured'])->name('cars.toggle-featured');
    Route::post('/cars/{car}/toggle-hot-deal', [AdminCarController::class, 'toggleHotDeal'])->name('cars.toggle-hot-deal');
    Route::post('/cars/{car}/toggle-active', [AdminCarController::class, 'toggleActive'])->name('cars.toggle-active');

    // Inquiries
    Route::resource('inquiries', InquiryController::class)->only(['index', 'show', 'destroy']);

    // Reservations
    Route::resource('reservations', AdminReservationController::class)->only(['index', 'show']);
    Route::post('/reservations/{reservation}/mark-sold', [AdminReservationController::class, 'markSold'])->name('reservations.mark-sold');
    Route::post('/reservations/{reservation}/cancel', [AdminReservationController::class, 'cancel'])->name('reservations.cancel');

    // About Us Management
    Route::get('/about', [\App\Http\Controllers\Admin\AboutController::class, 'index'])->name('about.index');
    Route::patch('/about/content', [\App\Http\Controllers\Admin\AboutController::class, 'updateContent'])->name('about.update-content');
    Route::post('/about/slides', [\App\Http\Controllers\Admin\AboutController::class, 'storeSlide'])->name('about.slides.store');
    Route::patch('/about/slides/{slide}', [\App\Http\Controllers\Admin\AboutController::class, 'updateSlide'])->name('about.slides.update');
    Route::delete('/about/slides/{slide}', [\App\Http\Controllers\Admin\AboutController::class, 'destroySlide'])->name('about.slides.destroy');
});
