<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use App\Models\Detail_Curas;
use Illuminate\Http\Request;
use App\Services\KMeansService;

class DetailCurasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail_curas = Detail_Curas::orderBy('updated_at', 'desc')->get();

        return view('admin.dashboardDetailCuras', compact('detail_curas'));
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
    public function show(Detail_Curas $detail_Curas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detail_Curas $detail_Curas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detail_Curas $detail_Curas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $detail = Detail_Curas::findOrFail($id);

            // Ambil curas terkait
            $curas = Curas::findOrFail($detail->curas_id);

            // Kurangi jumlah_curas
            $curas->jumlah_curas -= $detail->tambahan_curas;

            // Pastikan tidak negatif
            if ($curas->jumlah_curas < 0) {
                $curas->jumlah_curas = 0;
            }

            $curas->save(); // Simpan perubahan curas

            // Hapus detail_curas
            $detail->delete();

            $service = new KMeansService();
            $hasil = $service->hitungKMeansCuras();

            // simpan hasil ke file json
            file_put_contents(storage_path('app/public/hasil_kmeans_curas.json'), json_encode($hasil));

            $serviceSSECuras = new KMeansService();
            $serviceSSECuras->SSEElbowCuras();

            return redirect('/dashboard/detail-curas')->with('succes', 'Data berhasil dihapus dan curas diperbarui.');
        } catch (\Exception $e) {
            return redirect('/dashboard/detail-curas')->with('error', 'Terjadi kesalahan Ketika Menghapus Data : ' . $e->getMessage());
        }

    }

}
