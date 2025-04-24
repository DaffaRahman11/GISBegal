<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use App\Models\Klaster;
use App\Models\Curanmor;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
{
    $klasters = Klaster::orderBy('id', 'desc')->get(); 
    $updateCuras = Curas::latest('updated_at')->first();
    $tanggalCuras = \Carbon\Carbon::parse($updateCuras->updated_at)->translatedFormat('d F Y');
    $updateCuranmor = Curanmor::latest('updated_at')->first();
    $tanggalCuranmor = \Carbon\Carbon::parse($updateCuranmor->updated_at)->translatedFormat('d F Y');
    return view('landing', compact('klasters', 'tanggalCuras', 'tanggalCuranmor'));
}

}
