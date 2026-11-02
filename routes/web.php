<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuestController as AdminGuestController;
use App\Http\Controllers\Admin\WishController as AdminWishController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WeddingController::class, 'index'])->name('wedding.index');
Route::post('/wishes', [WishController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('wishes.store');

Route::get('/admin/login', [AuthController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('admin.login.store');
Route::post('/admin/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'can:manage-invitation'])
    ->group(function (): void {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('guests', AdminGuestController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('wishes', AdminWishController::class)->only(['index', 'update', 'destroy']);
    });
