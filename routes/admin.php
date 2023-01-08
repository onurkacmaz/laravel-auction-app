<?php

use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::name('auctions.')->prefix('auctions')->group(function () {
        Route::get('/', [AuctionController::class, 'index'])->name('index');
        Route::get('/new', [AuctionController::class, 'new'])->name('new');
        Route::post('/save/{id?}', [AuctionController::class, 'save'])->name('save');
        Route::get('/edit/{id}', [AuctionController::class, 'edit'])->name('edit');
        Route::get('/delete{id}', [AuctionController::class, 'destroy'])->name('destroy');
    });
    Route::name('artists.')->prefix('artists')->group(function () {
        Route::get('/', [ArtistController::class, 'index'])->name('index');
        Route::get('/{id}', [ArtistController::class, 'index'])->name('edit');
    });
});
