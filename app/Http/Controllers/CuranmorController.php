<?php

namespace App\Http\Controllers;

use App\Models\Klaster;
use App\Models\Curanmor;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Models\Detail_Curanmor;
use App\Services\KMeansService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CuranmorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curanmors = Curanmor::orderBy('jumlah_curanmor', 'desc')->get();
        return view('admin.dashboardListCuranmor', compact('curanmors'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboardTambahCuranmor', ['kecamatans' => Kecamatan::all()]);
    }

    /**
     *Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'jumlah_curanmor' => 'required|numeric',
        ]);
        try{

            DB::beginTransaction();

            $kecamatan_id = $request->kecamatan_id;
            $tambahan_curanmor = $request->jumlah_curanmor;
        
            
            $curanmor = Curanmor::where('kecamatan_id', $kecamatan_id)->first();
        
            if ($curanmor) {
                $curanmor->jumlah_curanmor += $tambahan_curanmor;
                $curanmor->save();
        
                $curanmor_id = $curanmor->id;
            } else {
                // Jika belum ada, bisa insert baru dulu (optional, sesuai kebutuhan)
                $curanmor = Curanmor::create([
                    'kecamatan_id' => $kecamatan_id,
                    'jumlah_curanmor' => $tambahan_curanmor,
                ]);
                $curanmor_id = $curanmor->id;
            }
            Detail_Curanmor::create([
                'curanmor_id' => $curanmor_id,
                'tambahan_curanmor' => $tambahan_curanmor,
                'detailCuranmor_kecamatan_Id' => $kecamatan_id,
                
            ]);

            $service = new KMeansService();
            $hasil = $service->hitungKMeansCuranmor();
            file_put_contents(storage_path('app/public/hasil_kmeans_curanmor.json'), json_encode($hasil));

            $serviceSSECuranmor = new KMeansService();
            $serviceSSECuranmor->SSEElbowCuranmor();

            DB::commit();
            return redirect('/dashboard/curanmor')->with('succes', 'Berhasil Menambahkan Data Curanmor Baru');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect('/dashboard/curanmor')->with('error', 'Gagal Menambahkan Data Curanmor Baru '. $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Curanmor $curanmor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($curanmor)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curanmor $curanmor)
    {
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($curanmor)
    {
    }
    
}
