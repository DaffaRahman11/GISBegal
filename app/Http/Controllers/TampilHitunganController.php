<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class TampilHitunganController extends Controller
{
    public function TampilHitungCuras()
    {
        $file = storage_path('app/public/hasil_kmeans_curas.json');

        if (!file_exists($file)) {
            return abort(404, 'File hasil KMeans tidak ditemukan.');
        }

        $data = json_decode(file_get_contents($file), true);

        // Ambil nama kecamatan berdasarkan ID
        $kecamatan = Kecamatan::pluck('nama_kecamatan', 'id')->toArray();

        return view('admin.HitungKmeans.HitunganCuras', compact('data', 'kecamatan'));
    }

    public function TampilHitungCuranmor()
    {
        $file = storage_path('app/public/hasil_kmeans_curanmor.json');

        if (!file_exists($file)) {
            return abort(404, 'File hasil KMeans tidak ditemukan.');
        }

        $data = json_decode(file_get_contents($file), true);

        // Ambil nama kecamatan berdasarkan ID
        $kecamatan = Kecamatan::pluck('nama_kecamatan', 'id')->toArray();

        return view('admin.HitungKmeans.HitunganCuranmor', compact('data', 'kecamatan'));
    }
}
