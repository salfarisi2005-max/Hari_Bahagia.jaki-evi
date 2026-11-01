<?php

use App\Http\Controllers\Admin\WishController as AdminWishController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman Utama Undangan)
|--------------------------------------------------------------------------
*/
Route::get('/', [WeddingController::class, 'index'])->name('wedding.index');

/*
|--------------------------------------------------------------------------
| API Routes (Ucapan & Doa via AJAX)
|--------------------------------------------------------------------------
*/
Route::prefix('api')->group(function () {
    Route::get('/wishes', [WishController::class, 'index']);
    Route::post('/wishes', [WishController::class, 'store']);
    Route::delete('/wishes/{id}', [WishController::class, 'destroy'])->middleware('auth');
});

/*
|--------------------------------------------------------------------------
| Admin Guest Routes (Hanya untuk yang BELUM Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');

    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes (Hanya untuk yang SUDAH Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminWishController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/wishes', [AdminWishController::class, 'store'])->name('admin.wishes.store');
    Route::put('/admin/wishes/{wish}', [AdminWishController::class, 'update'])->name('admin.wishes.update');
    Route::delete('/admin/wishes/{wish}', [AdminWishController::class, 'destroy'])->name('admin.wishes.destroy');

    // Logout Admin
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
