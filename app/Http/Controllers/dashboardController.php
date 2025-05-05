<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use App\Models\Curanmor;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $jumlahRawanCuras = Curas::where('klaster_id', '3')->count();
        $jumlahTotalCuras = Curas::count();
        $prosentaseCuras = ($jumlahRawanCuras / $jumlahTotalCuras) * 100; 

        $jumlahRawanCuranmor = Curanmor::where('klaster_id', '3')->count();
        $jumlahTotalCuranmor = Curanmor::count();
        $prosentaseCuranmor = ($jumlahRawanCuranmor / $jumlahTotalCuranmor) * 100; 
        
        $totalKecamatan = Kecamatan::count();

        $curasTertinggis = Curas::orderBy('jumlah_curas', 'desc')->take(5)->get();
        $curanmorTertinggis = Curanmor::orderBy('jumlah_curanmor', 'desc')->take(5)->get();


        $namaUser = Auth::user()->nama;
        return view('admin.dashboardAdmin', compact('jumlahRawanCuras', 'jumlahRawanCuranmor', 'namaUser', 'prosentaseCuras', 'prosentaseCuranmor', 'totalKecamatan', 'curasTertinggis', 'curanmorTertinggis'));
    }
}
