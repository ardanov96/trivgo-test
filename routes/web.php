<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\BookingController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('tour-packages', TourPackageController::class)->middleware(['auth']);

Route::resource('bookings', BookingController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
