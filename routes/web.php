<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\TopController;
use App\Http\Controllers\User\DeliveryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 未ログイン時のページ
Route::get('/', function () {
    return view('welcome');
});

// 認証関連（ログイン & 新規登録）
Route::prefix('user')->name('user.')->group(function () {
    // ログイン
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('show.login');
    Route::post('/login', [LoginController::class, 'login'])->name('login'); // ← nameを追加
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // 新規登録
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('show.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register'); // ← nameを追加

    // ログイン後のページ
    Route::middleware(['auth'])->group(function () {
        // トップページ
        Route::get('/top', [TopController::class, 'index'])->name('show.top');

        // 授業配信
        Route::get('/delivery/{id}', [DeliveryController::class, 'show'])->name('show.delivery');
        Route::post('/delivery/{id}/complete', [DeliveryController::class, 'complete'])->name('complete.delivery');

        // 時間割、授業進捗、プロフィール設定
        Route::get('/schedule', function () {
            return view('user.schedule');
        })->name('show.schedule');

        Route::get('/progress', function () {
            return view('user.progress');
        })->name('show.progress');

        Route::get('/profile', function () {
            return view('user.profile');
        })->name('show.profile');
    });
});

