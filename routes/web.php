<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

// 首页
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 认证路由
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// 课程路由
Route::prefix('lessons')->name('lessons.')->group(function () {
    Route::get('/', [LessonController::class, 'index'])->name('index');
    Route::get('/{lesson}', [LessonController::class, 'show'])->name('show');
    
    // 需要登录的路由
    Route::middleware('auth')->group(function () {
        Route::post('/{lesson}/progress', [LessonController::class, 'updateProgress'])->name('updateProgress');
    });
});

// 学习仪表板
Route::get('/dashboard', [LessonController::class, 'dashboard'])->middleware('auth')->name('dashboard');
