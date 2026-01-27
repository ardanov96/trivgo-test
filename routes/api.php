<?php
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/packages', function () {
    return TourPackage::where('is_active', true)->get();
});

Route::post('/packages', function (Request $request) {
    return TourPackage::create($request->all());
});
