<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatchAllController;
use App\Http\Controllers\CheckoutController;


Route::get('/', CheckoutController::class);
Route::fallback(CatchAllController::class);
