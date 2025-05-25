<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use App\Models\Klaster;
use App\Models\Curanmor;
use Illuminate\Http\Request;
use App\Services\KMeansService;

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
    public function runKmeans()
{
    
        $serviceKMeans = new KMeansService();
        $serviceKMeans->SSEElbowCuranmor();
        $serviceKMeans->SSEElbowCuras();
        $serviceKMeans->hitungDBSCANManual();
        $serviceKMeans->kmeansWithSilhouetteSingleMethod();
        

        $serviceKMeansCuras = new KMeansService();
        $hasilKMeansCuras = $serviceKMeansCuras->hitungKMeansCuras();
        file_put_contents(storage_path('app/public/hasil_kmeans_curas.json'), json_encode($hasilKMeansCuras));

        $serviceKmeansCuranmor = new KMeansService();
        $hasilKMeansCuranmor = $serviceKmeansCuranmor->hitungKMeansCuranmor();
        file_put_contents(storage_path('app/public/hasil_kmeans_curanmor.json'), json_encode($hasilKMeansCuranmor));

    return redirect('/dashboard/curanmor');
}


}
