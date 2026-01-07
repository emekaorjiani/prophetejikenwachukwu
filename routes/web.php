<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrayerRequestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\TrackVisitors::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/prayer-request', [PrayerRequestController::class, 'store'])->name('prayer-request.store');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// User Dashboard (for regular users to track their prayer requests)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/prayer-request', [UserDashboardController::class, 'storePrayerRequest'])->name('dashboard.prayer-request.store');
    Route::post('/dashboard/testimony', [UserDashboardController::class, 'storeTestimony'])->name('dashboard.testimony.store');
});

// Admin Routes (only for admin users)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Prayer Requests
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/download', [AdminController::class, 'download'])->name('download');
        Route::get('/prayer-request/{prayerRequest}/edit', [AdminController::class, 'prayerRequestEdit'])->name('prayer-request.edit');
        Route::put('/prayer-request/{prayerRequest}', [AdminController::class, 'update'])->name('prayer-request.update');
        
        // Testimonies
        Route::get('/testimonies', [AdminController::class, 'testimonies'])->name('testimonies');
        Route::get('/testimonies/create', [AdminController::class, 'testimonyCreate'])->name('testimonies.create');
        Route::get('/testimonies/{testimony}/edit', [AdminController::class, 'testimonyEdit'])->name('testimonies.edit');
        Route::post('/testimonies', [AdminController::class, 'testimonyStore'])->name('testimonies.store');
        Route::put('/testimonies/{testimony}', [AdminController::class, 'testimonyUpdate'])->name('testimonies.update');
        Route::post('/testimonies/{testimony}/approve', [AdminController::class, 'testimonyApprove'])->name('testimonies.approve');
        Route::post('/testimonies/{testimony}/reject', [AdminController::class, 'testimonyReject'])->name('testimonies.reject');
        Route::delete('/testimonies/{testimony}', [AdminController::class, 'testimonyDestroy'])->name('testimonies.destroy');
        
        // Videos
        Route::get('/videos', [AdminController::class, 'videos'])->name('videos');
        Route::get('/videos/create', [AdminController::class, 'videoCreate'])->name('videos.create');
        Route::get('/videos/{video}/edit', [AdminController::class, 'videoEdit'])->name('videos.edit');
        Route::post('/videos', [AdminController::class, 'videoStore'])->name('videos.store');
        Route::put('/videos/{video}', [AdminController::class, 'videoUpdate'])->name('videos.update');
        Route::delete('/videos/{video}', [AdminController::class, 'videoDestroy'])->name('videos.destroy');
        
        // Visitors
        Route::get('/visitors', [AdminController::class, 'visitors'])->name('visitors');
        
        // Contact Messages
        Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
        Route::put('/contacts/{contactMessage}', [AdminController::class, 'contactUpdate'])->name('contacts.update');
        Route::delete('/contacts/{contactMessage}', [AdminController::class, 'contactDestroy'])->name('contacts.destroy');
        
        // Users
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::post('/users/{user}/ban', [AdminController::class, 'userBan'])->name('users.ban');
        Route::post('/users/{user}/unban', [AdminController::class, 'userUnban'])->name('users.unban');
        Route::post('/users/{user}/reset-password', [AdminController::class, 'userResetPassword'])->name('users.reset-password');
        
        // Email Templates
        Route::get('/email-templates', [AdminController::class, 'emailTemplates'])->name('email-templates');
        Route::get('/email-templates/create', [AdminController::class, 'emailTemplateCreate'])->name('email-templates.create');
        Route::get('/email-templates/{emailTemplate}/edit', [AdminController::class, 'emailTemplateEdit'])->name('email-templates.edit');
        Route::post('/email-templates', [AdminController::class, 'emailTemplateStore'])->name('email-templates.store');
        Route::put('/email-templates/{emailTemplate}', [AdminController::class, 'emailTemplateUpdate'])->name('email-templates.update');
        Route::delete('/email-templates/{emailTemplate}', [AdminController::class, 'emailTemplateDestroy'])->name('email-templates.destroy');
        
        // Send Emails
        Route::get('/send-email', [AdminController::class, 'sendEmailForm'])->name('send-email');
        Route::post('/send-email', [AdminController::class, 'sendEmail'])->name('send-email.post');
    });
});
