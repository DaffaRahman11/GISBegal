<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurasController;
use App\Http\Controllers\loginController;
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

Route::get('/dashboard/mapcuras', function () {
    return view('admin.dashboardMapCuras');
});


Route::resource('/dashboard/kecamatan', KecamatanController::class) ->parameters(['data-kecamatan' => 'kecamatan']);
Route::resource('/dashboard/curas', CurasController::class);
Route::resource('/dashboard/curanmor', CuranmorController::class) ->parameters(['data-curanmor' => 'curanmor']);
Route::resource('/dashboard/klaster', KlasterController::class) ->parameters(['data-klaster' => 'klaster']);
Route::get('/dashboard/iterasiCuras', [hasilIterasiController::class, 'iterasiCuras']);
Route::get('/login', [loginController::class, 'index']);
Route::get('/kmeans-curas', [KmeansController::class, 'KMeansCuras']);
Route::get('/kmeans-curanmor', [KmeansController::class, 'KMeansCuranmor']);
