<?php

use App\Http\Controllers\Web\AdminDashboardController;
use App\Http\Controllers\Web\AdminUserController;
use App\Http\Controllers\Web\Auth\AuthenticatedAdminSessionController;
use App\Http\Controllers\Web\Auth\RegisteredAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return redirect('/admin/dashboard');
});

Route::group(['prefix' => 'admin'], function () {
    Route::fallback(function () {
        return redirect('/admin/dashboard');
    });

    Route::middleware('auth.admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

        Route::resource('admin-user', AdminUserController::class)->except('create', 'store');
        Route::put('admin-user/{admin_user}/status', [AdminUserController::class, 'manageStatus'])->name('admin-user.status');

        Route::post('logout', [AuthenticatedAdminSessionController::class, 'destroy'])->name('admin.logout');
    });

    Route::middleware('auth.admin.guest')->group(function () {
        Route::get('register', [RegisteredAdminController::class, 'create'])->name('admin.register');
        Route::post('register', [RegisteredAdminController::class, 'store']);

        Route::get('login', [AuthenticatedAdminSessionController::class, 'create'])->name('admin.login');
        Route::post('login', [AuthenticatedAdminSessionController::class, 'store']);
    });
});
