<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\User\ProgressController;

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

Auth::routes();


//ユーザー
Route::prefix('user')->name('user.')->group(function () {
    //お知らせ詳細画面
    Route::get('/article/{id}', [UserArticleController::class, 'showArticle'])->name('show.article');
    //プロフィール画面表示
    Route::get('/profile', [ProfileController::class, 'showProfileForm'])->name('show.profile');
    //プロフィール編集
    Route::put('/profile', [ProfileController::class, 'profileUpdate'])->name('profile.edit');
    //ﾊﾟｽﾜｰﾄﾞ変更表示
    Route::get('/password', [ProfileController::class, 'showPasswordFrom'])->name('show.password.edit');
    //ﾊﾟｽﾜｰﾄﾞ変更
    Route::put('/password', [ProfileController::class, 'passwordUpdate'])->name('password.edit');
    //授業進捗画面
    Route::get('/progress', [ProgressController::class, 'showProgress'])->name('show.progress');
});


//管理
Route::prefix('admin')->name('admin.')->group(function () {

    //お知らせ一覧画面
    Route::get('/article_list', [AdminArticleController::class, 'showArticleList'])->name('show.article.list');
    //お知らせ一登録画面
    Route::get('/article_create', [AdminArticleController::class, 'showArticleCreate'])->name('show.article.create');
    //お知らせ登録
    Route::post('/article_create', [AdminArticleController::class, 'ArticleCreate'])->name('article.create');
    //お知らせ編集画面
    Route::get('/article_edit/{id}', [AdminArticleController::class, 'showArticleEdit'])->name('show.article.edit');
    //お知らせ編集
    Route::put('/article_edit/{id}', [AdminArticleController::class, 'ArticleEdit'])->name('article.edit');
    //お知らせ削除
    Route::delete('/article_delete/{id}', [AdminArticleController::class, 'ArticleDelete'])->name('article.delete');

});


