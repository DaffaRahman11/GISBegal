<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use App\Models\Klaster;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboardListCuras', ['Curases' => Curas::all()]);

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
        try{
            $validateData = $request->validate([
                'kecamatan_id' =>'required|max:255|exists:kecamatans,id|unique:curas,kecamatan_id',
                'jumlah_curas' =>'required',
                'klaster_id' =>'required|max:255|exists:klasters,id',

            ]);
    
            Curas::create($validateData);
            return redirect('/curas')->with('succes', 'Berhasil Menambahkan Data Curas Baru');
        }catch (\Exception $e){
            return redirect('/curas')->with('error', 'Gagal Menambahkan Data Curas Baru');
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
        try {

            $edit = Curas::find($curas);
            
            return view('admin.dashboardEditCuras', [
                'curas' => $edit,
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
    public function update(Request $request, Curas $curas)
    {
        try {
            $validateData = $request->validate([
                'kecamatan_id' => 'sometimes|required|max:255' . $curas->kecamatan_id,
                'jumlah_curas' => 'sometimes|required|integer',
                'klaster_id' => 'sometimes|required|max:255' . $curas->klaster_id,
                
            ]);
    
            // Pastikan hanya field yang diisi yang akan diperbarui
            $curas->update(array_filter($validateData));
    
            return redirect('/curas')->with('succes', 'Data Kecamatan Berhasil Diubah');
        } catch (\Exception $e) {
            
            return redirect('/curas')->with('error', 'Data Kecamatan Gagal Diubah');
        }
    }
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($curas)
    {
        try{
            $hapus = Curas::find($curas);
            Curas::destroy($hapus);
            return redirect('/curas')->with('succes', 'Data Curas Berhasil Di Hapus');

        }catch (\Exception $e){

            return dd($e);
            // redirect('/curas')->with('error', 'Data Curas '. $curas->nama_kecamatan .' Gagal Di Hapus | Hapus Data Curas Atau Curanmor Untuk Klaster '. $curas->nama_kecamatan.' Terlebih Dahulu');
        }
    }
}
