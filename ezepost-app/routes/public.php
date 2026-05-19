<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPageController;

Route::get('/', [PublicPageController::class, 'home'])->name('home');
Route::get('/pricing', [PublicPageController::class, 'pricing'])->name('pricing');
Route::get('/download', [PublicPageController::class, 'download'])->name('download');
Route::get('/about', [PublicPageController::class, 'about'])->name('about');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');
