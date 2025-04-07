<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class hasilIterasiController extends Controller
{
    public function iterasiCuras()
    {
        $iterasi = session('hasil_iterasi');
        dd($iterasi);

    // Kirim ke view atau proses lainnya
    return view('admin.dashboarditerasiCuras', compact('iterasi'));
    }
}
