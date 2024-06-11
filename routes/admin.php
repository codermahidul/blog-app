<?php

use App\Http\Controllers\Admin\AdminAuthenticateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

//------------------------------------

Route::group(['prefix' => 'admin', 'as' => 'admin.'],function(){
    Route::get('login', [AdminAuthenticateController::class, 'login'])->name('login');
    Route::post('login', [AdminAuthenticateController::class, 'handleLogin'])->name('handle-login');
    Route::get('forgot-password', [AdminAuthenticateController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('forgot-password', [AdminAuthenticateController::class, 'sendResetLink'])->name('forgot-email');
    Route::get('reset-password/{token}/{email}', [AdminAuthenticateController::class, 'resetPassword'])->name('reset-password');
    Route::post('update-password', [AdminAuthenticateController::class, 'updatePassword'])->name('update-password');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'],function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AdminAuthenticateController::class, 'logout'])->name('logout');
    Route::put('adminpassword/update/{id}', [ProfileController::class, 'passwordUpdate'])->name('password.update');
    Route::resource('profile', ProfileController::class);
    // Language
    Route::resource('language', LanguageController::class);
    //Category
    Route::resource('category', CategoryController::class);
    //News
    Route::get('fatch-category',[NewsController::class, 'fatchCategory'])->name('fatchCategory');
    Route::resource('news',NewsController::class);
});