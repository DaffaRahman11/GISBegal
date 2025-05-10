<?php

namespace App\Http\Controllers;

use App\Models\Curanmor;
use Illuminate\Http\Request;
use App\Models\Detail_Curanmor;
use App\Services\KMeansService;
use Illuminate\Support\Facades\DB;

class DetailCuranmorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail_curanmor = Detail_Curanmor::orderBy('updated_at', 'desc')->get();

        return view('admin.dashboardDetailCuranmor', compact('detail_curanmor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Detail_Curanmor $detail_Curanmor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detail_Curanmor $detail_Curanmor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detail_Curanmor $detail_Curanmor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            DB::beginTransaction();
            $detail = Detail_Curanmor::findOrFail($id);

            $curanmor = Curanmor::findOrFail($detail->curanmor_id);

            $curanmor->jumlah_curanmor -= $detail->tambahan_curanmor;

            // Pastikan tidak negatif
            if ($curanmor->jumlah_curanmor < 0) {
                $curanmor->jumlah_curanmor = 0;
            }

            $curanmor->save(); 

            $detail->delete();

            $service = new KMeansService();
            $hasil = $service->hitungKMeansCuranmor();

            // simpan hasil ke file json
            file_put_contents(storage_path('app/public/hasil_kmeans_curanmor.json'), json_encode($hasil));

            $serviceSSECuranmor = new KMeansService();
            $serviceSSECuranmor->SSEElbowCuranmor();

            DB::commit();

            return redirect('/dashboard/detail-curanmor')->with('succes', 'Data berhasil dihapus dan curanmor diperbarui.');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect('/dashboard/detail-curanmor')->with('error', 'Terjadi kesalahan Ketika Menghapus Data : ' . $e->getMessage());
        }
    }
}
