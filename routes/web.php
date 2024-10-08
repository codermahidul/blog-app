<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//---------------------------------------------

Route::get('/',[HomeController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Language
Route::get('/lang', LanguageController::class)->name('lang');
//News Details
Route::get('/news-details/{slug}', [HomeController::class, 'showNews'])->name('news.details');

require __DIR__.'/auth.php';
