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
            'warna'=> '#27AE60',
        ]);
        
        Klaster::create([
            'nama_klaster'=> 'Sedang',
            'warna'=> '#F1C40F',
        ]);
        
        Klaster::create([
            'nama_klaster'=> 'Rawan',
            'warna'=> '#E74C3C',
        ]);
        }
}
