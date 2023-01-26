<?php

use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\ArtWorkController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AuctionController::class, 'index'])->name('index');
    Route::name('auctions.')->prefix('auctions')->group(function () {
        Route::get('/', [AuctionController::class, 'index'])->name('index');
        Route::get('/new', [AuctionController::class, 'new'])->name('new');
        Route::post('/save/{id?}', [AuctionController::class, 'save'])->name('save');
        Route::get('/edit/{id}', [AuctionController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [AuctionController::class, 'destroy'])->name('destroy');

        Route::name('artworks.')->prefix('{auction_id?}/artworks')->group(function () {
            Route::get('/new', [ArtWorkController::class, 'new'])->name('new');
            Route::get('/edit/{id}', [ArtWorkController::class, 'edit'])->name('edit');
            Route::post('/save/{id?}', [ArtWorkController::class, 'save'])->name('save');
            Route::get('/delete/{id}', [ArtWorkController::class, 'destroy'])->name('destroy');
        });
    });
    Route::name('artists.')->prefix('artists')->group(function () {
        Route::get('/', [ArtistController::class, 'index'])->name('index');
        Route::get('/new', [ArtistController::class, 'new'])->name('new');
        Route::get('/edit/{id}', [ArtistController::class, 'edit'])->name('edit');
        Route::post('/save/{id?}', [ArtistController::class, 'save'])->name('save');
        Route::get('/delete/{id}', [ArtistController::class, 'destory'])->name('destroy');
    });
    Route::name('settings.')->prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::get('/new', [SettingController::class, 'new'])->name('new');
        Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('edit');
        Route::post('/save/{id?}', [SettingController::class, 'save'])->name('save');
        Route::get('/delete/{id}', [SettingController::class, 'destroy'])->name('destroy');

    });
    Route::name('users.')->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [UserController::class, 'form'])->name('edit');
        Route::post('/save/{id}', [UserController::class, 'save'])->name('save');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
});
