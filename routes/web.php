<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ArticleController;

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

//ユーザー
Route::prefix('user')->name('user.')->group(function () {
    //お知らせ詳細画面
    Route::get('/article/{id}', [ArticleController::class, 'showArticle'])->name('show.article');

});


//管理
Route::prefix('admin')->name('admin.')->group(function () {

});