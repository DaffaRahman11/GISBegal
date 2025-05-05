<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurasController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\KmeansController;
use App\Http\Controllers\KlasterController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CuranmorController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DetailCurasController;
use App\Http\Controllers\DetailCuranmorController;
use App\Http\Controllers\TampilHitunganController;

// Route Landing
Route::get('/', [LandingController::class, 'index']);
Route::get('/blank', function () {
    return view('admin.dashboardBlank');
});

// Route Auth
Route::post('/login', [loginController::class, 'authenticate']);
Route::post('/logout', [loginController::class, 'logout']);
Route::get('/login', [loginController::class, 'index'])->name('login');

// Route Fitur Utama Controller 
Route::get('/dashboard', [dashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard/TampilHitungCuras', [TampilHitunganController::class, 'TampilHitungCuras'])->middleware('auth');
Route::get('/dashboard/TampilHitungCuranmor', [TampilHitunganController::class, 'TampilHitungCuranmor'])->middleware('auth');
Route::resource('/dashboard/kecamatan', KecamatanController::class) ->parameters(['data-kecamatan' => 'kecamatan'])->middleware('auth');
Route::resource('/dashboard/klaster', KlasterController::class) ->parameters(['data-klaster' => 'klaster'])->middleware('auth');
Route::resource('/dashboard/curas', CurasController::class)->middleware('auth');
Route::resource('/dashboard/curanmor', CuranmorController::class) ->parameters(['data-curanmor' => 'curanmor'])->middleware('auth');
Route::resource('/dashboard/detail-curas', DetailCurasController::class)->middleware('auth');
Route::resource('/dashboard/detail-curanmor', DetailCuranmorController::class)->middleware('auth');

// Route Fitur Tampil Map Admin
Route::get('/dashboard/mapcuras', function () {
    return view('admin.dashboardMapCuras');
})->middleware('auth');
Route::get('/dashboard/mapcuranmor', function () {
    return view('admin.dashboardMapCuranmor');
})->middleware('auth');

// Route K-Means Centroid Tetap
Route::get('/kmeans-curas', [KmeansController::class, 'KMeansCuras'])->middleware('auth');
Route::get('/kmeans-curanmor', [KmeansController::class, 'KMeansCuranmor'])->middleware('auth');
