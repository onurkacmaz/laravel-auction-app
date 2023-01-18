<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtWorkController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::name('auctions.')->prefix('auctions')->group(function () {
    Route::get('/', [AuctionController::class, 'index'])->name('index');
    Route::get('/{id}', [AuctionController::class, 'show'])->name('show');
    Route::name('artworks.')->prefix('product')->group(function () {
        Route::get('/{id}', [ArtworkController::class, 'show'])->name('show');
        Route::post('/{id}/bidding', [ArtworkController::class, 'bidding'])->name('bidding');
        Route::name('favorite.')->prefix('favorite')->group(function () {
            Route::post('/{id}', [ArtworkController::class, 'addFavorite'])->name('favorite');
        });
        Route::name('follow.')->prefix('follow')->group(function () {
            Route::post('/{id}', [ArtworkController::class, 'follow'])->name('follow');
        });
    });
});

Route::name('artists.')->prefix('artists')->group(function () {
    Route::get('/{id}', [ArtistController::class, 'show'])->name('show');
});
