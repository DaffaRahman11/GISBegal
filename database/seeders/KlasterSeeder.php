<?php

namespace Database\Seeders;

use App\Models\Klaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KlasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Klaster::create([
            'nama_klaster'=> 'Aman',
            'warna'=> 'Hijau',
        ]);
        
        Klaster::create([
            'nama_klaster'=> 'Sedang',
            'warna'=> 'Kuning',
        ]);
        
        Klaster::create([
            'nama_klaster'=> 'Rawan',
            'warna'=> 'Merah',
        ]);
    }
}
