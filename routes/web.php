<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurasController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\KmeansController;
use App\Http\Controllers\KlasterController;
use App\Http\Controllers\CuranmorController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DetailCurasController;
use App\Http\Controllers\hasilIterasiController;
use App\Http\Controllers\DetailCuranmorController;

Route::get('/', function () {
    return view('landing');
});


Route::resource('/dashboard/detail-curas', DetailCurasController::class)->middleware('auth');
Route::resource('/dashboard/detail-curanmor', DetailCuranmorController::class)->middleware('auth');


Route::get('/blank', function () {
    return view('admin.dashboardBlank');
});

Route::get('/dashboard/mapcuras', function () {
    return view('admin.dashboardMapCuras');
})->middleware('auth');
Route::get('/dashboard/mapcuranmor', function () {
    return view('admin.dashboardMapCuranmor');
})->middleware('auth');

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware('auth');
Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login', [loginController::class, 'authenticate']);
Route::post('/logout', [loginController::class, 'logout']);
Route::resource('/dashboard/kecamatan', KecamatanController::class) ->parameters(['data-kecamatan' => 'kecamatan'])->middleware('auth');
Route::resource('/dashboard/curas', CurasController::class)->middleware('auth');
Route::resource('/dashboard/curanmor', CuranmorController::class) ->parameters(['data-curanmor' => 'curanmor'])->middleware('auth');
Route::resource('/dashboard/klaster', KlasterController::class) ->parameters(['data-klaster' => 'klaster'])->middleware('auth');

Route::get('/dashboard/iterasiCuras', [hasilIterasiController::class, 'iterasiCuras'])->middleware('auth');

Route::get('/kmeans-curas', [KmeansController::class, 'KMeansCuras']);
Route::get('/kmeans-curanmor', [KmeansController::class, 'KMeansCuranmor']);
