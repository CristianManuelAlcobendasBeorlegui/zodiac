<?php

use App\Http\Controllers\HoroscopeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/{lang_iso_code}/{time}/{sign}', [HoroscopeController::class, 'getHoroscope']);