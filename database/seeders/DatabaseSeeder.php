<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Curas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Services\KMeansService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            KlasterSeeder::class,
            KecamatanSeeder::class,
            UserSeeder::class,
            CurasSeeder::class,
            CuranmorSeeder::class,
        ]);

        $serviceKMeans = new KMeansService();
        $serviceKMeans->SSEElbowCuranmor();
        $serviceKMeans->SSEElbowCuras();

        $serviceKMeansCuras = new KMeansService();
        $hasilKMeansCuras = $serviceKMeansCuras->hitungKMeansCuras();
        file_put_contents(storage_path('app/public/hasil_kmeans_curas.json'), json_encode($hasilKMeansCuras));

        $serviceKmeansCuranmor = new KMeansService();
        $hasilKMeansCuranmor = $serviceKmeansCuranmor->hitungKMeansCuranmor();
        file_put_contents(storage_path('app/public/hasil_kmeans_curanmor.json'), json_encode($hasilKMeansCuranmor));
    }
}
