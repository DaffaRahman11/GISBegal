<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use App\Models\Klaster;
use App\Models\Kecamatan;
use App\Models\Detail_Curas;
use Illuminate\Http\Request;
use App\Services\KMeansService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CurasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curases = Curas::orderBy('jumlah_curas', 'desc')->get();
        return view('admin.dashboardListCuras', compact('curases'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        return view('admin.dashboardTambahCuras', ['kecamatans' => Kecamatan::all()], ['klasters' => Klaster::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'jumlah_curas' => 'required|numeric',
        ]);
        try{

            DB::beginTransaction();
            
            $kecamatan_id = $request->kecamatan_id;
            $tambahan_curas = $request->jumlah_curas;
        
            // 2. Ambil data curas berdasarkan kecamatan_id
            $curas = Curas::where('kecamatan_id', $kecamatan_id)->first();
        
            if ($curas) {
                // 3. Update jumlah_curas dengan nilai yang baru
                $curas->jumlah_curas += $tambahan_curas;
                $curas->save();
        
                $curas_id = $curas->id;
            } else {
                // Jika belum ada, bisa insert baru dulu (optional, sesuai kebutuhan)
                $curas = Curas::create([
                    'kecamatan_id' => $kecamatan_id,
                    'jumlah_curas' => $tambahan_curas,
                ]);
                $curas_id = $curas->id;
            }
        
            // 4. Tambah data ke tabel detail_curas
            Detail_Curas::create([
                'curas_id' => $curas_id,
                'tambahan_curas' => $tambahan_curas,
                'detailCuras_kecamatan_Id' => $kecamatan_id,
                
            ]);

            $service = new KMeansService();
            $hasil = $service->hitungKMeansCuras();
            
            file_put_contents(storage_path('app/public/hasil_kmeans_curas.json'), json_encode($hasil));

            $serviceSSECuras = new KMeansService();
            $serviceSSECuras->SSEElbowCuras();
            
            DB::commit(); 

            return redirect('/dashboard/curas')->with('succes', 'Data curas berhasil ditambahkan.');
        }catch (\Exception $e){

            DB::rollBack(); 
            return redirect('/dashboard/curas')->with('error', 'Gagal Menambahkan Data Curas Baru'. $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Curas $curas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($curas)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($curas)
    {
    }
    

}
