<?php

use App\Http\Controllers\Web\AdminDashboardController;
use App\Http\Controllers\Web\AdminUserController;
use App\Http\Controllers\Web\Auth\AuthenticatedAdminSessionController;
use App\Http\Controllers\Web\Auth\RegisteredAdminController;
use App\Http\Controllers\Web\CallbackLogController;
use App\Http\Controllers\Web\IncomingLogController;
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

        Route::resource('admin-users', AdminUserController::class)->except('create', 'store');
        Route::put('admin-users/{admin_user}/role', [AdminUserController::class, 'manageRole'])->name('admin-users.role');

        Route::get('callback-logs', [CallbackLogController::class, 'index'])->name('callback-logs.index');
        Route::get('callback-logs/{callback_log}', [CallbackLogController::class, 'show'])->name('callback-logs.show');

        Route::get('incoming-logs', [IncomingLogController::class, 'index'])->name('incoming-logs.index');
        Route::get('incoming-logs/{incoming_log}', [IncomingLogController::class, 'show'])->name('incoming-logs.show');

        Route::post('logout', [AuthenticatedAdminSessionController::class, 'destroy'])->name('admin.logout');
    });

    Route::middleware('auth.admin.guest')->group(function () {
        Route::get('register', [RegisteredAdminController::class, 'create'])->name('admin.register');
        Route::post('register', [RegisteredAdminController::class, 'store']);

        Route::get('login', [AuthenticatedAdminSessionController::class, 'create'])->name('admin.login');
        Route::post('login', [AuthenticatedAdminSessionController::class, 'store']);
    });
});
