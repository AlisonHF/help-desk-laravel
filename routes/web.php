<?php

use App\Http\Controllers\HomeController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/** Auth */

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});