<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use App\Models\Klaster;
use App\Models\Curanmor;
use Illuminate\Http\Request;

class KmeansController extends Controller
{
    public function KMeansCuras()
    {
        $data = Curas::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curas')->orderBy('jumlah_curas', 'asc')->get();

        $k = Klaster::count('id');
        $maxIterasi = 100;
        $centroids = $data->random($k)->values()->map(function ($item) {
            return [
                'jumlah_curas' => $item->jumlah_curas,
            ];
        });

        $iterasi = [];
        $prevAssignment = [];

        for ($i = 0; $i < $maxIterasi; $i++) {
            $clustered = [];
            $currentAssignment = [];

            foreach ($data as $item) {
                $jarak = [];

                foreach ($centroids as $idx => $centroid) {
                    $dist = abs($item->jumlah_curas - $centroid['jumlah_curas']);
                    $jarak["jarakC" . ($idx + 1)] = $dist;
                }

                $iterasi[$i][] = array_merge(['kecamatan_id' => $item->kecamatan_id], $jarak);

                $minIndex = array_keys($jarak, min($jarak))[0]; // e.g. "jarakC2"
                $clusterNumber = (int) str_replace("jarakC", "", $minIndex);

                $clustered[$clusterNumber][] = $item;
                $item->temp_klaster = $clusterNumber;
                $currentAssignment[$item->id] = $clusterNumber;
            }

            // ✨ Cek konvergensi: jika assignment sekarang == sebelumnya, break
            if ($currentAssignment === $prevAssignment) {
                break;
            }

            $prevAssignment = $currentAssignment;

            

            // Update centroid berdasarkan rata-rata
            foreach ($clustered as $key => $group) {
                $avg = collect($group)->avg('jumlah_curas');
                $centroids = $centroids->map(function ($item, $index) use ($key, $avg) {
                    return $index === ($key - 1)
                        ? ['jumlah_curas' => $avg]
                        : $item;
                });
            }
        }
        

        // Final mapping centroid ke klaster_id (aman/sedang/rawan)
        $finalCentroids = $centroids->map(function ($item, $index) {
            return ['index' => $index + 1, 'jumlah_curas' => $item['jumlah_curas']];
        })->sortBy('jumlah_curas')->values();

        $centroidToKlaster = [];

        foreach ($finalCentroids as $i => $centroid) {
            // Klaster ID mulai dari 1 (asumsi klaster di DB bernomor 1, 2, 3, ...)
            $centroidToKlaster[$centroid['index']] = $i + 1;
        }


        // Update ke database
        foreach ($data as $item) {
            Curas::where('id', $item->id)->update([
                'klaster_id' => $centroidToKlaster[$item->temp_klaster],
            ]);
        }

        session(['hasil_iterasi' => $iterasi]);

        return response()->json($iterasi);
    }

    public function KMeansCuranmor()
{
    $data = Curanmor::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curanmor')->orderBy('jumlah_curanmor', 'asc')->get();
    $maxIterasi = 100;
    $hasilElbow = [];

    for ($k = 1; $k <= 10; $k++) {
        // Ambil centroid awal secara acak
        $centroids = $data->random($k)->values()->map(function ($item) {
            return ['jumlah_curanmor' => $item->jumlah_curanmor];
        });

        $prevAssignment = [];

        for ($i = 0; $i < $maxIterasi; $i++) {
            $clustered = [];
            $currentAssignment = [];

            foreach ($data as $item) {
                $jarak = [];

                foreach ($centroids as $idx => $centroid) {
                    $dist = abs($item->jumlah_curanmor - $centroid['jumlah_curanmor']);
                    $jarak[$idx] = $dist;
                }

                $minIndex = array_keys($jarak, min($jarak))[0];
                $clustered[$minIndex][] = $item;
                $currentAssignment[$item->id] = $minIndex;
                $item->temp_klaster = $minIndex;
            }

            if ($currentAssignment === $prevAssignment) break;
            $prevAssignment = $currentAssignment;

            foreach ($clustered as $key => $group) {
                $avg = collect($group)->avg('jumlah_curanmor');
                $centroids[$key] = ['jumlah_curanmor' => $avg];
            }
        }

        // Hitung SSE (Sum of Squared Errors)
        $sse = 0;
        foreach ($data as $item) {
            $centroidVal = $centroids[$item->temp_klaster]['jumlah_curanmor'];
            $sse += pow($item->jumlah_curanmor - $centroidVal, 2);
        }

        $hasilElbow[] = ['k' => $k, 'sse' => $sse];
    }

    // Simpan hasil Elbow Method ke file
    file_put_contents(storage_path('app/public/hasil_elbow_curanmor.json'), json_encode($hasilElbow, JSON_PRETTY_PRINT));

    // ===================== //
    // === Hitung k akhir === //
    // ===================== //

    $k = Klaster::count(); // misalnya 3
    $centroids = $data->random($k)->values()->map(function ($item) {
        return ['jumlah_curanmor' => $item->jumlah_curanmor];
    });

    $iterasi = [];
    $prevAssignment = [];

    for ($i = 0; $i < $maxIterasi; $i++) {
        $clustered = [];
        $currentAssignment = [];

        foreach ($data as $item) {
            $jarak = [];

            foreach ($centroids as $idx => $centroid) {
                $dist = abs($item->jumlah_curanmor - $centroid['jumlah_curanmor']);
                $jarak["jarakC" . ($idx + 1)] = $dist;
            }

            $iterasi[$i][] = array_merge(['kecamatan_id' => $item->kecamatan_id], $jarak);

            $minIndex = array_keys($jarak, min($jarak))[0];
            $clusterNumber = (int) str_replace("jarakC", "", $minIndex);

            $clustered[$clusterNumber][] = $item;
            $item->temp_klaster = $clusterNumber;
            $currentAssignment[$item->id] = $clusterNumber;
        }

        if ($currentAssignment === $prevAssignment) {
            break;
        }

        $prevAssignment = $currentAssignment;

        foreach ($clustered as $key => $group) {
            $avg = collect($group)->avg('jumlah_curanmor');
            $centroids = $centroids->map(function ($item, $index) use ($key, $avg) {
                return $index === ($key - 1)
                    ? ['jumlah_curanmor' => $avg]
                    : $item;
            });
        }
    }

    $finalCentroids = $centroids->map(function ($item, $index) {
        return ['index' => $index + 1, 'jumlah_curanmor' => $item['jumlah_curanmor']];
    })->sortBy('jumlah_curanmor')->values();

    $centroidToKlaster = [];

    foreach ($finalCentroids as $i => $centroid) {
        $centroidToKlaster[$centroid['index']] = $i + 1;
    }

    foreach ($data as $item) {
        Curanmor::where('id', $item->id)->update([
            'klaster_id' => $centroidToKlaster[$item->temp_klaster],
        ]);
    }

    session(['hasil_iterasi' => $iterasi]);
    return $iterasi;
}

}
