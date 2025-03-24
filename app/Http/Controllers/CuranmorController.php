<?php

namespace App\Http\Controllers;

use App\Models\Klaster;
use App\Models\Curanmor;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

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
    public function edit(Curanmor $curanmor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curanmor $curanmor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curanmor $curanmor)
    {
        try{
            $hapus = Curanmor::find($curanmor);
            Curanmor::destroy($hapus);
            return redirect('/curanmor')->with('succes', 'Data Curanmor Berhasil Di Hapus');

        }catch (\Exception $e){

            return redirect('/curanmor')->with('error', 'Data Curanmor '. $curanmor->nama_kecamatan .' Gagal Di Hapus');
        }
    }
}
