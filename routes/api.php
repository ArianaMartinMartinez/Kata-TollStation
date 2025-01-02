<?php

use App\Http\Controllers\Api\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/vehicles', [VehicleController::class, 'index'])->name('apiHomeVehicles');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('apiShowVechicle');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('apiStoreVehicle');
Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->nameç('apiUpdateVehicles');
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('apiDestroyVehicle');