<?php

namespace Database\Seeders;

use App\Models\Curas;
use App\Models\Klaster;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurasSeeder extends Seeder
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
        Curas::create([
            'kecamatan_id' => $kecamatanId1->id,
            'jumlah_curas' => 32,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
        Curas::create([
            'kecamatan_id' => $kecamatanId2->id,
            'jumlah_curas' => 77,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
        Curas::create([
            'kecamatan_id' => $kecamatanId3->id,
            'jumlah_curas' => 44,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
        Curas::create([
            'kecamatan_id' => $kecamatanId4->id,
            'jumlah_curas' => 5,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
        Curas::create([
            'kecamatan_id' => $kecamatanId5->id,
            'jumlah_curas' => 55,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
        Curas::create([
            'kecamatan_id' => $kecamatanId6->id,
            'jumlah_curas' => 43,
            'klaster_id' => $klasterId->random(), // Ambil klaster secara acak
        ]);
    }
}
