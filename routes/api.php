<?php

use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/vehicles', [VehicleController::class, 'index'])->name('apiHomeVehicles');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('apiShowVehicle');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('apiStoreVehicle');
Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('apiUpdateVehicle');
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('apiDestroyVehicle');

Route::get('/stations', [StationController::class, 'index'])->name('apiHomeStations');
Route::get('/stations/{id}', [StationController::class, 'show'])->name('apiShowStation');