<?php

use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\StationVehicleController;
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
Route::post('/stations', [StationController::class, 'store'])->name('apiStoreStation');
Route::put('/stations/{id}', [StationController::class, 'update'])->name('apiUpdateStation');
Route::delete('/stations/{id}', [StationController::class, 'destroy'])->name('apiDestroyStation');

Route::get('/tolls', [StationVehicleController::class, 'index'])->name('apiHomeTolls');
Route::get('/tolls/{id}', [StationVehicleController::class, 'show'])->name('apiShowToll');
Route::post('/tolls', [StationVehicleController::class, 'store'])->name('apiStoreToll');
Route::put('/tolls/{id}', [StationVehicleController::class, 'update'])->name('apiUpdateToll');
Route::delete('/tolls/{id}', [StationVehicleController::class, 'destroy'])->name('apiDestroyToll');