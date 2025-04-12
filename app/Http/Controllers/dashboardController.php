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
        $jumlahRawanCuranmor = Curanmor::where('klaster_id', '3')->count();
        $jumlahTotalCuranmor = Curanmor::count();
        $namaUser = Auth::user()->nama;
        $prosentaseCuras = ($jumlahRawanCuras / $jumlahTotalCuras) * 100; 
        $prosentaseCuranmor = ($jumlahRawanCuranmor / $jumlahTotalCuranmor) * 100; 
        $totalKecamatan = Kecamatan::count();
        return view('admin.dashboardAdmin', compact('jumlahRawanCuras', 'jumlahRawanCuranmor', 'namaUser', 'prosentaseCuras', 'prosentaseCuranmor', 'totalKecamatan'));
    }
}
