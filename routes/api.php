<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\OrdersIntentController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::resource('events', EventController::class);
Route::resource('orders-intents ', OrdersIntentController::class);

Route::resource('orders', OrderController::class);
Route::get('/tickets/{id}/download', [TicketController::class, 'download'])->name('tickets.download');

Route::resource('tickets', TicketController::class);
Route::resource('ticket-types', TicketTypeController::class);
