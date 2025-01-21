<?php

use App\Http\Controllers\StationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/stations', [StationController::class, 'index'])->name('stationsHome');
Route::get('/stations/{id}', [StationController::class, 'show'])->name('stationsShow');