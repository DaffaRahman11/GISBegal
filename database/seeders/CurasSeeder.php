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
        $klasterIds = Klaster::pluck('id'); // Ambil semua ID klaster
        $kecamatanIds = Kecamatan::pluck('id'); // Ambil semua ID kecamatan

        // Data jumlah curas untuk setiap kecamatan (sesuaikan dengan kebutuhan)
        $dataCuras = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 1,
            6 => 1,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
            13 => 0,
            14 => 0,
            15 => 0,
            16 => 0,
            17 => 0,
            18 => 0,
            19 => 0,
            20 => 1,
            21 => 0,
            22 => 0,
            23 => 1,
            24 => 0,
        ];

        // Looping untuk membuat data curas berdasarkan kecamatan
        foreach ($kecamatanIds as $kecamatanId) {
            Curas::create([
                'kecamatan_id' => $kecamatanId,
                'jumlah_curas' => $dataCuras[$kecamatanId], // Gunakan nilai default jika tidak ada data
                'klaster_id' => $klasterIds->random(), // Pilih klaster secara acak
            ]);
        }
    }
}
