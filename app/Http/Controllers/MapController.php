<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use App\Models\Curanmor;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function mapCuras()
    {
        $data = Curas::with(['punyaKecamatanCuras', 'punyaKlasterCuras'])->get()->map(function ($item) {
            return [
                'kecamatan' => $item->punyaKecamatanCuras->nama_kecamatan,
                'jumlah_curas' => $item->jumlah_curas,
                'klaster' => $item->punyaKlasterCuras?->nama_klaster ?? 'Tidak Diketahui',
                'warna' => $item->punyaKlasterCuras?->warna ?? '#cccccc' // warna tetap dipakai untuk pewarnaan peta
            ];
        });
        return response()->json($data);
        
    }

    // CuranmorController.php
    public function mapCuranmor()
    {
        $data = Curanmor::with(['punyaKecamatanCuranmor', 'punyaKlasterCuranmor'])->get()->map(function ($item) {
            return [
                'kecamatan' => $item->punyaKecamatanCuranmor->nama_kecamatan,
                'jumlah_curanmor' => $item->jumlah_curanmor,
                'klaster' => $item->punyaKlasterCuranmor?->nama_klaster ?? 'Tidak diketahui',
                'warna' => $item->punyaKlasterCuranmor?->warna ?? '#cccccc'
            ];
        });

        return response()->json($data);
    }

}
