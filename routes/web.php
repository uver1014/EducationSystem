<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\User\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ユーザー認証ルート
Route::prefix('user')->namespace('user')->name('user.')->group(function () {
    Route::get('/login',[UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',[UserLoginController::class,'login']);
    Route::get('/register',[UserRegisterController::class,'showRegisterForm'])->name('register');
    Route::post('/register',[UserRegisterController::class,'register']); 
});

//管理者認証ルート
Route::prefix('admin')->namespace('admin')->name('admin.')->group(function () {
    Route::get('/login',[AdminLoginController::class,'showLoginForm'])->name('login');
    Route::post('/login',[AdminLoginController::class,'login']);
    Route::get('/register',[AdminRegisterController::class,'showRegisterForm'])->name('register');
    Route::post('/register',[AdminRegisterController::class,'register']);
});