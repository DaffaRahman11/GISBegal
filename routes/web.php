<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurasController;
use App\Http\Controllers\KlasterController;
use App\Http\Controllers\CuranmorController;
use App\Http\Controllers\KecamatanController;

Route::get('/', function () {
    return view('admin.login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboardAdmin');
});

Route::get('/blank', function () {
    return view('admin.dashboardBlank');
});

Route::resource('/kecamatan', KecamatanController::class) ->parameters(['data-kecamatan' => 'kecamatan']);
Route::resource('/Curas', CurasController::class) ->parameters(['data-curas' => 'curas']);
Route::resource('/Curanmor', CuranmorController::class) ->parameters(['data-curanmor' => 'curanmor']);
Route::resource('/Klaster', KlasterController::class) ->parameters(['data-klaster' => 'klaster']);
