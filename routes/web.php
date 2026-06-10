<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChamadosController;
use App\Http\Controllers\HomeController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index']);

/** Auth */

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/chamados', [ChamadosController::class, 'list'])->name('chamados');
    Route::get('/chamados/new', [ChamadosController::class, 'new'])->name('chamados.new');
});
