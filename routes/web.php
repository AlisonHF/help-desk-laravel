<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index']);

/** Auth */

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/ticket', [TicketController::class, 'list'])->name('ticket.list');
    Route::get('ticket/view/{ticket}', [TicketController::class,'view'])
        ->middleware('can:view,ticket')
        ->name('ticket.view');
    Route::get('/ticket/new', [TicketController::class, 'new'])->name('ticket.new');
    Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/ticket/edit/{ticket}', [TicketController::class, 'edit'])
        ->middleware('can:update,ticket')
        ->name('ticket.edit');
    Route::patch('/ticket/update/{ticket}', [TicketController::class, 'update'])
        ->middleware('can:update,ticket')
        ->name('ticket.update');
    Route::delete('/ticket/delete/{ticket}', [TicketController::class, 'delete'])
        ->middleware('can:delete,ticket')
        ->name('ticket.delete');
    Route::post('ticket/resolveCall/{ticket}', [TicketController::class, 'resolveCall'])
        ->middleware('can:resolveCall,ticket')
        ->name('ticket.resolve');

    Route::post('chat/store/{ticket}', [ChatController::class, 'store'])->name('chat.store');

    Route::get('notification/{id}/read', [NotificationController::class,'read'])->name('notification.read');

});
