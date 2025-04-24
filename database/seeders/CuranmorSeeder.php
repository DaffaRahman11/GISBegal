<?php

namespace Database\Seeders;

use App\Models\Klaster;
use App\Models\Curanmor;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class CuranmorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $klasterIds = Klaster::pluck('id'); // Ambil semua ID klaster
        $kecamatanIds = Kecamatan::pluck('id'); // Ambil semua ID kecamatan

        // Data jumlah curanmor untuk setiap kecamatan
        $dataCuranmor= [
            1 => 5,
            2 => 4,
            3 => 2,
            4 => 22,
            5 => 4,
            6 => 18,
            7 => 0,
            8 => 37,
            9 => 9,
            10 => 3,
            11 => 2,
            12 => 13,
            13 => 1,
            14 => 21,
            15 => 14,
            16 => 4,
            17 => 10,
            18 => 0,
            19 => 1,
            20 => 10,
            21 => 1,
            22 => 2,
            23 => 15,
            24 => 4,
        ];

        $defaultDate = '2024-12-31 00:00:00';
        // Looping untuk membuat data curanmor berdasarkan kecamatan
        foreach ($kecamatanIds as $kecamatanId) {
            Curanmor::create([
                'kecamatan_id' => $kecamatanId,
                'jumlah_curanmor' => $dataCuranmor[$kecamatanId], // Gunakan nilai default jika tidak ada data
                'klaster_id' => $klasterIds->random(), // Pilih klaster secara acak
                'created_at' => $defaultDate,
                'updated_at' => $defaultDate,
            ]);
        }
    }
}
