<?php

namespace Database\Seeders;

use App\Models\Klaster;
use App\Models\Curanmor;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CuranmorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $klasterId = Klaster::pluck('id');
        $kecamatanId1 = Kecamatan::where('id', '1')->first();
        $kecamatanId2 = Kecamatan::where('id', '2')->first();
        $kecamatanId3 = Kecamatan::where('id', '3')->first();
        $kecamatanId4 = Kecamatan::where('id', '4')->first();
        $kecamatanId5 = Kecamatan::where('id', '5')->first();
        $kecamatanId6 = Kecamatan::where('id', '6')->first();

        
        // Buat data kecamatan dengan klaster_id yang valid
        Curanmor::create([
            'kecamatan_id' => $kecamatanId1->id,
            'jumlah_curanmor' => 90, 
            'klaster_id' => $klasterId->random(),// Ambil klaster secara acak
        ]);
        Curanmor::create([
            'kecamatan_id' => $kecamatanId2->id,
            'jumlah_curanmor' => 76,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
        Curanmor::create([
            'kecamatan_id' => $kecamatanId3->id,
            'jumlah_curanmor' => 23,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
        Curanmor::create([
            'kecamatan_id' => $kecamatanId4->id,
            'jumlah_curanmor' => 87,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
        Curanmor::create([
            'kecamatan_id' => $kecamatanId5->id,
            'jumlah_curanmor' => 56,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
        Curanmor::create([
            'kecamatan_id' => $kecamatanId6->id,
            'jumlah_curanmor' => 54,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
    }
}
