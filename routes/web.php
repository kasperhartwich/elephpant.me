<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ElephpantController;
use App\Http\Controllers\HerdController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TradeController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/home', '/');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/species', [ElephpantController::class, 'index'])->name('elephpants.index');
Route::get('/herd/{username}', [HerdController::class, 'show'])->name('herds.show');
Route::get('/ranking', [RankingController::class, 'index'])->name('rankings.index');
Route::get('/user/{username}', [HerdController::class, 'show'])->name('heard.show');
Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-herd', [HerdController::class, 'edit'])->name('herds.edit');
    Route::get('/my-herd/stats', [HerdController::class, 'stats'])->name('herds.stats');
    Route::get('/trade', [TradeController::class, 'index'])->name('trades.index');
    Route::get('/trade/senders/{elephpantId}', [TradeController::class, 'senders'])->name('trades.senders');
    Route::get('/trade/receivers/{elephpantId}', [TradeController::class, 'receivers'])->name('trades.receivers');
    Route::put('/adoption/{elephpant}', [AdoptionController::class, 'update'])->name('adoptions.update');
    Route::get('/photo/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('/photo', [PhotoController::class, 'store'])->name('photos.store');
    Route::post('/message', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
