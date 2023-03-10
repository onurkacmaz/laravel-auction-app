<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AccountController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::name('profile.')->prefix('account')->group(function () {
        Route::get('/', [AccountController::class, 'edit'])->name('edit');
        Route::patch('/', [AccountController::class, 'update'])->name('update');
        Route::delete('/', [AccountController::class, 'destroy'])->name('destroy');
        Route::name('artworks.')->prefix('artworks')->group(function () {
            Route::get('/', [AccountController::class, 'artworks'])->name('index');
            Route::get('/{id}', [AccountController::class, 'artwork'])->name('show');
        });
        Route::name('my-bids.')->prefix('my-bids')->group(function () {
            Route::get('/', [AccountController::class, 'myBids'])->name('index');
        });
        Route::name('my-favorites.')->prefix('my-favorites')->group(function () {
            Route::get('/', [FavoriteController::class, 'myFavorites'])->name('index');
            Route::get('/delete/{id}', [FavoriteController::class, 'destroy'])->name('destroy');
        });
        Route::name('my-follows.')->prefix('my-follows')->group(function () {
            Route::get('/', [FollowController::class, 'myFollows'])->name('index');
            Route::get('/delete/{id}', [FollowController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

