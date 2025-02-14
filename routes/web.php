<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\LikeController;
Route::get('/', [TweetController::class, 'index'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
