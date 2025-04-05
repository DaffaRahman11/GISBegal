<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Curas::with(['punyaKecamatanCuras', 'punyaKlasterCuras'])->get()->map(function ($item) {
            return [
                'kecamatan' => $item->punyaKecamatanCuras->nama_kecamatan, // pastikan nama kolom benar
                'jumlah_curas' => $item->jumlah_curas,
                'klaster' => $item->punyaKlasterCuras?->warna ?? '#cccccc' // fallback warna abu-abu jika tidak ada
            ];
        });

        return response()->json($data);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
