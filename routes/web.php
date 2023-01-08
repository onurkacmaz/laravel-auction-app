<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::name('auctions.')->prefix('auctions')->group(function () {
    Route::get('/', [AuctionController::class, 'index'])->name('index');
    Route::get('/{id}', [AuctionController::class, 'show'])->name('show');
});

Route::name('artists.')->prefix('artists')->group(function () {
    Route::get('/{id}', [ArtistController::class, 'show'])->name('show');
});
