<?php

namespace Database\Seeders;

use App\Models\Curas;
use App\Models\Klaster;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class CurasSeeder extends Seeder
{
    public function run(): void
    {
        $klasterIds = Klaster::pluck('id'); 
        $kecamatanIds = Kecamatan::pluck('id');

        
        $dataCuras = [
            1 => 0,
            2 => 1,
            3 => 2,
            4 => 1,
            5 => 1,
            6 => 1,
            7 => 0,
            8 => 1,
            9 => 1,
            10 => 0,
            11 => 0,
            12 => 0,
            13 => 0,
            14 => 0,
            15 => 1,
            16 => 0,
            17 => 0,
            18 => 0,
            19 => 0,
            20 => 1,
            21 => 0,
            22 => 0,
            23 => 3,
            24 => 2,
        ];

        
        $defaultDate = '2024-12-31 00:00:00';  // Default date to be used for both created_at and updated_at

        foreach ($kecamatanIds as $kecamatanId) {
            Curas::create([
                'kecamatan_id' => $kecamatanId,
                'jumlah_curas' => $dataCuras[$kecamatanId],
                'klaster_id' => $klasterIds->random(),
                'created_at' => $defaultDate,
                'updated_at' => $defaultDate,
            ]);
        }
    }
}
