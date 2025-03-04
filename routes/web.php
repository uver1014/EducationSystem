<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\TopController;
use App\Http\Controllers\LessonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

//ログイン関連のルート
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//新規会員登録のルート
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//トップページ（ログイン必須）
Route::middleware(['auth'])->group(function () {
    Route::get('/top', [TopController::class, 'index'])->name('user.top');

//授業(配信)のルート
Route::get('/lesson/{id}', [LessonController::class, 'show'])->name('lesson.show');

//受講完了のルート
Route::post('/lesson/{id}/complete', [LessonController::class, 'complete'])->name('lesson.complete');

// 時間割画面のルート（ログイン必須）
Route::middleware(['auth'])->group(function () {
    Route::get('/schedule', function () {
        return view('user.schedule'); // 画面がまだないなら仮ビュー作成
    })->name('user.schedule');

    Route::get('/progress', function () {
        return view('user.progress');
    })->name('user.progress');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('user.profile');
});


});
