<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\AdminAuth\LoginController;
use App\Http\Controllers\AdminAuth\LogoutController;
use App\Http\Controllers\AdminAuth\ProfileController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LogoutController::class, 'logout'])->name('admin.logout');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');

    Route::get('/admin/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('admin.change_password_form');
    Route::post('/admin/profile/change-password', [ProfileController::class, 'changePassword'])->name('admin.change_password');
});

Route::post('/admin/verify-password', [AdminController::class, 'verifyPassword'])->name('admin.verifyPassword');

Route::resource('users', UserController::class);
Route::resource('lockers', LockerController::class);