<?php

namespace App\Http\Controllers;

use App\Models\Klaster;
use Illuminate\Http\Request;
use App\Services\KMeansService;
use Illuminate\Support\Facades\DB;

class KlasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboardListKlaster', ['klasters' => Klaster::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboardTambahKlaster');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_klaster' =>'required|max:255|unique:klasters,nama_klaster',
            'warna' =>'required|max:255',
        ]);
        
        DB::beginTransaction();

        try{

            Klaster::create($validateData);


            $serviceKMeans = new KMeansService();
            $serviceKMeans->SSEElbowCuranmor();
            $serviceKMeans->SSEElbowCuras();
    
            $hasilKMeansCuras = $serviceKMeans->hitungKMeansCuras();
            file_put_contents(storage_path('app/public/hasil_kmeans_curas.json'), json_encode($hasilKMeansCuras));
    
            $hasilKMeansCuranmor = $serviceKMeans->hitungKMeansCuranmor();
            file_put_contents(storage_path('app/public/hasil_kmeans_curanmor.json'), json_encode($hasilKMeansCuranmor));
            
            DB::commit();

            return redirect('/dashboard/klaster')->with('succes', 'Berhasil Menambahkan Klaster Baru');
        }catch (\Exception $e){
            
            DB::rollBack();

            return redirect('/dashboard/klaster')->with('error', 'Gagal Menambahkan Klaster Baru ' .$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Klaster $klaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Klaster $klaster)
    {
        try {
            
            return view('admin.dashboardEditKlaster', [
                'klaster' => $klaster
            ]);
        } catch (\Exception $e) {
            abort(404); // Jika dekripsi gagal, tampilkan halaman 404
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Klaster $klaster)
    {
        $validateData = $request->validate([
            'nama_klaster' => 'sometimes|required|max:255|unique:klasters,nama_klaster,' . $klaster->id,
            'warna' => 'sometimes|required|max:255',
        ]);

        try {
            DB::beginTransaction();
            // Hanya update data yang diisi (tidak mengganti dengan null)
            Klaster::where('id', $klaster->id)->update(array_filter($validateData));
            
            $serviceKMeans = new KMeansService();
            $serviceKMeans->SSEElbowCuranmor();
            $serviceKMeans->SSEElbowCuras();
    
            $hasilKMeansCuras = $serviceKMeans->hitungKMeansCuras();
            file_put_contents(storage_path('app/public/hasil_kmeans_curas.json'), json_encode($hasilKMeansCuras));
    
            $hasilKMeansCuranmor = $serviceKMeans->hitungKMeansCuranmor();
            file_put_contents(storage_path('app/public/hasil_kmeans_curanmor.json'), json_encode($hasilKMeansCuranmor));

            DB::commit();

            return redirect('/dashboard/klaster')->with('success', 'Data Klaster Berhasil Diubah');
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect('/dashboard/klaster')->with('error', 'Data Klaster Gagal Diubah');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Klaster $klaster)
    {
        try{

            DB::beginTransaction();
            Klaster::destroy($klaster->id);
            DB::commit();

            $serviceKMeans = new KMeansService();
            $serviceKMeans->SSEElbowCuranmor();
            $serviceKMeans->SSEElbowCuras();
    
            $hasilKMeansCuras = $serviceKMeans->hitungKMeansCuras();
            file_put_contents(storage_path('app/public/hasil_kmeans_curas.json'), json_encode($hasilKMeansCuras));
    
            $hasilKMeansCuranmor = $serviceKMeans->hitungKMeansCuranmor();
            file_put_contents(storage_path('app/public/hasil_kmeans_curanmor.json'), json_encode($hasilKMeansCuranmor));

            return redirect('/dashboard/klaster')->with('succes', 'Data Klaster Berhasil Di Hapus');

        }catch (\Exception $e){

            DB::rollBack();
            return redirect('/dashboard/klaster')->with('error', 'Data Klaster '. $klaster->nama_kecamatan .' Gagal Di Hapus | Hapus Data Curas Atau Curanmor Untuk Klaster '. $klaster->nama_kecamatan.' Terlebih Dahulu '. $e->getMessage());
        }
    }
}