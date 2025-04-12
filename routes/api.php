<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

Route::get('/map/curas', [MapController::class, 'mapCuras']);
Route::get('/map/curanmor', [MapController::class, 'mapCuranmor']);
