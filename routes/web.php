<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

// 1. Login routes (GET shows form, POST processes login)
Route::match(['get', 'post'], '/', [LoginController::class, 'handleLogin'])->name('login');

// Dashboard (protected)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// 3. Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Buy Now Routes
Route::get('/buy-now', [ProductController::class, 'buyNow'])->name('buy-now');
Route::post('/purchase', [ProductController::class, 'purchase'])->name('purchase');




Route::get('/my-profile', [UserController::class, 'editProfile'])->name('user.profile');
Route::post('/my-profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');

 Route::get('/profile-image', [UserController::class, 'editProfileImage'])->name('user.profile.image');
    Route::post('/profile-image/upload', [UserController::class, 'uploadProfileImage'])->name('user.profile.image.upload');

    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('user.change-password');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change-password.update');

      // Change transaction password
    Route::get('/change-transaction-password', [UserController::class, 'showChangeTransactionPasswordForm'])->name('user.change-transaction-password');
    Route::post('/change-transaction-password', [UserController::class, 'changeTransactionPassword'])->name('user.change-transaction-password.update');
    
    // Forgot transaction password
    Route::get('/forgot-transaction-password', [UserController::class, 'showForgotTransactionPasswordForm'])->name('user.forgot-transaction-password');
    Route::post('/forgot-transaction-password', [UserController::class, 'forgotTransactionPassword'])->name('user.forgot-transaction-password.submit');


     Route::get('/welcome-letter', [UserController::class, 'welcomeLetter'])->name('user.welcome-letter');

      Route::get('/visiting-card', [UserController::class, 'visitingCard'])->name('user.visiting-card');
    Route::post('/visiting-card/download', [UserController::class, 'downloadVisitingCard'])->name('user.visiting-card.download');
     Route::get('/signup-acknowledgement', [UserController::class, 'signupAcknowledgement'])->name('user.signup-acknowledgement');