<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kecamatan::create([
            'nama_kecamatan'=> 'Leces',
        ]);
        
        Kecamatan::create([
            'nama_kecamatan'=> 'Tegalsiwalan',
        ]);
        
        Kecamatan::create([
            'nama_kecamatan'=> 'Dringu',
        ]);
        
        Kecamatan::create([
            'nama_kecamatan'=> 'Kraksaan',
        ]);
        
        Kecamatan::create([
            'nama_kecamatan'=> 'Gending',
        ]);
        
        Kecamatan::create([
            'nama_kecamatan'=> 'Gading',
        ]);
    }
}
