<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurasController;
use App\Http\Controllers\KmeansController;
use App\Http\Controllers\KlasterController;
use App\Http\Controllers\CuranmorController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\hasilIterasiController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('admin.dashboardAdmin');
});

Route::get('/blank', function () {
    return view('admin.dashboardBlank');
});

Route::get('/mapcuras', function () {
    return view('admin.dashboardMapCuras');
});


Route::resource('/kecamatan', KecamatanController::class) ->parameters(['data-kecamatan' => 'kecamatan']);
Route::resource('/curas', CurasController::class);
Route::resource('/curanmor', CuranmorController::class) ->parameters(['data-curanmor' => 'curanmor']);
Route::resource('/klaster', KlasterController::class) ->parameters(['data-klaster' => 'klaster']);
Route::get('/kmeans-curas', [KmeansController::class, 'KMeansCuras']);
Route::get('/kmeans-curanmor', [KmeansController::class, 'KMeansCuranmor']);
Route::get('/iterasiCuras', [hasilIterasiController::class, 'iterasiCuras']);
