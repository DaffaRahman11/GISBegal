<?php

namespace App\Http\Controllers;

use App\Models\Klaster;
use App\Models\Curanmor;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CuranmorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboardListCuranmor', ['curanmors' => Curanmor::all()]);
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
            return redirect('/curanmor')->with('succes', 'Berhasil Menambahkan Data Curanmor Baru');
        }catch (\Exception $e){
            return redirect('/curanmor')->with('error', 'Gagal Menambahkan Data Curanmor Baru');
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
                    'jumlah_curanmor' => 'required|integer|min:0',
                ]);
    
                // Update data
                $curanmor->update([
                    'kecamatan_id' => $request->kecamatan_id,
                    'klaster_id' => $request->klaster_id,
                    'jumlah_curanmor' => $request->jumlah_curanmor,
                ]);
    
                return redirect('/curanmor')->with('succes', 'Data Kecamatan Berhasil Diubah');
            } catch (\Exception $e) {
                return redirect('/curanmor')->with('error', 'Data Kecamatan Gagal Diubah: ' . $e->getMessage());
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
                return redirect('/curanmor')->with('error', 'Data tidak ditemukan.');
            }

            // Hapus data
            $hapus->delete();

            return redirect('/curanmor')->with('succes', 'Data Curanmor Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect('/curanmor')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
}
