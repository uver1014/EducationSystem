<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\LoginController;

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

//Auth::routes();
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('curriculums_list', [CurriculumController::class, 'showCurriculumList'])->name('show.curriculum.list');
    Route::get('curriculums/{id}', [CurriculumController::class, 'gradeCurriculums'])->name('gradeCurriculums');
    Route::get('/curriculum_edit/{id}', [CurriculumController::class, 'showCurriculumEdit'])->name('show.curriculum.edit');
    Route::get('/curriculum_edit', [CurriculumController::class, 'createCurriculum'])->name('show.curriculum.create');
    Route::post('/curriculum_update/{id}', [CurriculumController::class, 'update'])->name('curriculum.update');
    Route::get('/delivery_time_edit/{id}', [DeliveryController::class, 'showDeliveryEdit'])->name('delivery.setting');
    Route::post('/curriculum_store', [CurriculumController::class, 'store'])->name('curriculum.store');
    Route::post('/delivery_time_edit/{id}', [DeliveryController::class, 'update'])->name('delivery.update');
    Route::get('/article_list', [ArticleController::class, 'showArticleList'])->name('show.article.list');
    Route::get('/banner_edit', [BannerController::class, 'showBannerEdit'])->name('show.banner.edit');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('show.login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});