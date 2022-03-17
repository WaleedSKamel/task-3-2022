<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// auth
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('search', [HomeController::class,'search'])->name('search');
Route::get('article/show/{id}', [HomeController::class,'show'])->name('article.detail');


Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('post.login');
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('post.register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('category', CategoryController::class)->except('show');
    Route::resource('article', ArticleController::class)->except('show');
});


