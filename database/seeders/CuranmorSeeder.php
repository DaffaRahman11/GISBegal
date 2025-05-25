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
            1 => 11,
            2 => 14,
            3 => 21,
            4 => 59,
            5 => 8,
            6 => 42,
            7 => 13,
            8 => 188,
            9 => 30,
            10 => 13,
            11 => 4,
            12 => 33,
            13 => 3,
            14 => 48,
            15 => 53,
            16 => 12,
            17 => 30,
            18 => 5,
            19 => 4,
            20 => 10,
            21 => 5,
            22 => 7,
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
