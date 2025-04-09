<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// ログイン関連
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// メッセージ関連
Route::get('/messages', [MessageController::class, 'list'])->middleware('auth')->name('messages.list');
Route::get('/messages/{user}', [MessageController::class, 'show'])->middleware('auth')->name('messages.show');
Route::post('/messages', [MessageController::class, 'store'])->middleware('auth')->name('messages.store');
Route::post('/send-message', [MessageController::class, 'sendMessage'])->middleware('auth');
