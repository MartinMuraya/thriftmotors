<?php

use App\Http\Controllers\MpesaController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// M-Pesa STK Push callback — must be publicly accessible, no CSRF
Route::post('/mpesa/callback', [MpesaController::class, 'callback']);

// Reservation payment status polling
Route::get('/reservations/{reservation}/status', [ReservationController::class, 'checkStatus']);
