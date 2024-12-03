<?php

use App\Http\Controllers\Web\AdminDashboardController;
use App\Http\Controllers\Web\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::resource('admin-user', AdminUserController::class)->except('create', 'store');
    Route::put('admin-user/{admin_user}/status', [AdminUserController::class, 'manageStatus'])->name('admin-user.status');
});
