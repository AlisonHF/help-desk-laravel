<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\HomeController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index']);

/** Auth */

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/ticket', [TicketController::class, 'list'])->name('ticket.list');
    Route::get('/ticket/new', [TicketController::class, 'new'])->name('ticket.new');

    Route::post('ticket/store', [TicketController::class, 'store'])->name('ticket.store');

});
