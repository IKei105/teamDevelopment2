<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RecruitmentController;

//登録画面へ遷移する
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ログイン関連
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// メッセージ関連
//メッセージ一覧
Route::get('/messages', [MessageController::class, 'list'])->middleware('auth')->name('messages.list');
//他のユーザーとのメッセージを開く
Route::get('/messages/{user}', [MessageController::class, 'show'])->middleware('auth')->name('messages.show');
Route::post('/messages', [MessageController::class, 'store'])->middleware('auth')->name('messages.store');
Route::post('/send-message', [MessageController::class, 'sendMessage'])->middleware('auth');
Route::get('/fetch-messages/{user}', [MessageController::class, 'fetchNewMessages'])->middleware('auth');

//募集検索
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/result', [SearchController::class, 'search'])->name('search.result');

//募集投稿
Route::get('/recruitments/create', [RecruitmentController::class, 'create'])->name('recruitments.create');
//募集一覧
Route::post('/recruitments', [RecruitmentController::class, 'store'])->name('recruitments.store');

//自分の登録情報を出力
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');