<?php

use App\Http\Controllers\StationController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/stations', [StationController::class, 'index'])->name('stationsHome');
Route::get('/stations/{id}', [StationController::class, 'show'])->name('stationsShow');

Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehiclesHome');