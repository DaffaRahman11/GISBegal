<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboardListKecamatan', ['kecamatans' => Kecamatan::all()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboardTambahKecamatan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validateData = $request->validate([
                'nama_kecamatan' =>'required|max:255|unique:kecamatans,nama_kecamatan',
            ]);
    
            Kecamatan::create($validateData);
            return redirect('/dashboard/kecamatan')->with('succes', 'Berhasil Menambahkan Data Kecamatan Baru');
        }catch (\Exception $e){
            return redirect('/dashboard/kecamatan')->with('error', 'Gagal Menambahkan Data Kecamatan Baru');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Kecamatan $kecamatan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kecamatan $kecamatan)
    {
        try {
            
            return view('admin.dashboardEditKecamatan', [
                'kecamatan' => $kecamatan
            ]);
        } catch (\Exception $e) {
            abort(404); // Jika dekripsi gagal, tampilkan halaman 404
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        try{
            $validateData = $request->validate([
                'nama_kecamatan' =>'required|max:255|unique:kecamatans,nama_kecamatan',
            ]);
    
            Kecamatan::where('id', $kecamatan->id)->update($validateData);
            return redirect('/dashboard/kecamatan')->with('succes', 'Data Kecamatan Berhasil Di Ubah');
        }catch (\Exception $e){
            return redirect('/dashboard/kecamatan')->with('error', 'Data Kecamatan Gagal Di Ubah');
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan)
    {
        try{
            Kecamatan::destroy($kecamatan->id);
            return redirect('/dashboard/kecamatan')->with('succes', 'Data Kecamatan Berhasil Di Hapus');

        }catch (\Exception $e){
            return redirect('/dashboard/kecamatan')->with('error', 'Data Kecamatan '. $kecamatan->nama_kecamatan .' Gagal Di Hapus | Hapus Data Curas Atau Curanmor Untuk Kecamatan '. $kecamatan->nama_kecamatan.' Terlebih Dahulu');
        }
        
    
    }
}
