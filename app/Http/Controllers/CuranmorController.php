<?php

namespace App\Http\Controllers;

use App\Models\Klaster;
use App\Models\Curanmor;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Services\KMeansService;
use Illuminate\Validation\Rule;

class CuranmorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curanmors = Curanmor::orderBy('jumlah_curanmor', 'asc')->get();
        return view('admin.dashboardListCuranmor', compact('curanmors'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboardTambahCuranmor', ['kecamatans' => Kecamatan::all()], ['klasters' => Klaster::all()]);
    }

    /**
     *Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validateData = $request->validate([
                'kecamatan_id' =>'required|max:255|exists:kecamatans,id|unique:curanmors,kecamatan_id',
                'jumlah_curanmor' =>'required',
                'klaster_id' =>'required|max:255|exists:klasters,id',

            ]);
    
            Curanmor::create($validateData);
            return redirect('/dashboard/curanmor')->with('succes', 'Berhasil Menambahkan Data Curanmor Baru');
        }catch (\Exception $e){
            return redirect('/dashboard/curanmor')->with('error', 'Gagal Menambahkan Data Curanmor Baru');
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
        try {

            $edit = Curanmor::find($curanmor);
            
            return view('admin.dashboardEditCuranmor', [
                'curanmor' => $edit,
                'kecamatans' => Kecamatan::all(),
                'klasters' => Klaster::all(),
            ]);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curanmor $curanmor)
    {
            try {
    
                // Validasi input
                $request->validate([
                    'kecamatan_id' => [
                        'required',
                        'exists:kecamatans,id',
                        Rule::unique('curanmors')->ignore($curanmor->id),
                    ],
                    'klaster_id' => 'required|exists:klasters,id',
                    'jumlah_curanmor' => 'required|numeric|min:0',
                ]);
    
                // Update data
                $curanmor->update([
                    'kecamatan_id' => $request->kecamatan_id,
                    'klaster_id' => $request->klaster_id,
                    'jumlah_curanmor' => $request->jumlah_curanmor,
                ]);

            $service = new KMeansService();
            $hasil = $service->hitungKMeansCuranmor();

            // simpan hasil ke file json
            file_put_contents(storage_path('app/public/hasil_kmeans_curanmor.json'), json_encode($hasil));
    
                return redirect('/dashboard/curanmor')->with('succes', 'Data Kecamatan Berhasil Diubah');
            } catch (\Exception $e) {
                return redirect('/dashboard/curanmor')->with('error', 'Data Kecamatan Gagal Diubah: ' . $e->getMessage());
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($curanmor)
    {
        try {
            // Cari data berdasarkan ID
            $hapus = Curanmor::find($curanmor);

            // Pastikan data ditemukan sebelum menghapus
            if (!$hapus) {
                return redirect('/dashboard/curanmor')->with('error', 'Data tidak ditemukan.');
            }

            // Hapus data
            $hapus->delete();

            return redirect('/dashboard/curanmor')->with('succes', 'Data Curanmor Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/curanmor')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
}
