<?php

use App\Http\Controllers\Api\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/vehicles', [VehicleController::class, 'index'])->name('apiHomeVehicles');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('apiShowVechicle');