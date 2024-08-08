<?php

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RevenueShareController;
use Illuminate\Support\Facades\Route;

Route::post('/purchase-subscription', [PurchaseController::class, 'purchase']);
Route::get('/revenue-share', [RevenueShareController::class, 'calculate']);