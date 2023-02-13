<?php

use App\Http\Controllers\ArtWorkController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
use App\Http\Services\IdeaSoft\IdeaSoftService;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::name('auctions.')->prefix('auctions')->group(function () {
    Route::get('/{id}', [AuctionController::class, 'show'])->name('show');
    Route::name('artworks.')->prefix('product')->group(function () {
        Route::get('/', [ArtworkController::class, 'index'])->name('index');
        Route::get('/{id}', [ArtworkController::class, 'show'])->name('show');
        Route::get('/{id}/bids', [ArtWorkController::class, 'bids'])->name('bids');
        Route::post('/{id}/bidding', [ArtworkController::class, 'bidding'])->name('bidding');
        Route::name('favorite.')->prefix('favorite')->group(function () {
            Route::post('/{id}', [ArtworkController::class, 'addFavorite'])->name('favorite');
        });
        Route::name('follow.')->prefix('follow')->group(function () {
            Route::post('/{id}', [ArtworkController::class, 'follow'])->name('follow');
        });
    });
});

Route::name('notifications.')->prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'notifications'])->name('index');
    Route::post('/markAsRead/{id?}', [NotificationController::class, 'markAsRead'])->name('markAsRead');
});

Route::get('search', [SearchController::class, 'search'])->name('search');

Route::get('authorize', [IdeaSoftService::class, 'authorize'])->name('ideasoft.authorize');
Route::get('themes', [IdeaSoftService::class, 'getThemeSettings'])->name('ideasoft.themes');

Route::get('archive', [AuctionController::class, 'archive'])->name('archive');

Route::post('send-application', [HomeController::class, 'sendApplication'])->name('send-application');
