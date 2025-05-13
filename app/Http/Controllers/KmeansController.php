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

        $maxIterasi = 100;


        $centroidManual = [0, 1, 3]; 
        $centroids = collect($centroidManual)->map(function ($value) {
            return ['C' => $value];
        });

        $centroidAwal = $centroids->toArray();

        $iterasi = [];
        $prevAssignment = [];

        for ($i = 0; $i < $maxIterasi; $i++) {
            $clustered = [];
            $currentAssignment = [];

            foreach ($data as $item) {
                $jarak = [];

                foreach ($centroids as $idx => $centroid) {
                    $dist = abs($item->jumlah_curas - $centroid['C']);
                    $jarak["C" . ($idx + 1)] = $dist;
                }

                $iterasi[$i][] = array_merge(['kecamatan_id' => $item->kecamatan_id], $jarak);

                $minIndex = array_keys($jarak, min($jarak))[0];
                $clusterNumber = (int) str_replace("C", "", $minIndex);

                $clustered[$clusterNumber][] = $item;
                $item->temp_klaster = $clusterNumber;
                $currentAssignment[$item->id] = $clusterNumber;
            }

            if ($currentAssignment === $prevAssignment) {
                break;
            }

            $prevAssignment = $currentAssignment;

            // Update centroid berdasarkan rata-rata
            foreach ($clustered as $key => $group) {
                $avg = collect($group)->avg('jumlah_curas');
                $centroids = $centroids->map(function ($item, $index) use ($key, $avg) {
                    return $index === ($key - 1)
                        ? ['C' => $avg]
                        : $item;
                });
            }
        }

        // Final mapping centroid ke klaster_id
        $finalCentroids = $centroids->map(function ($item, $index) {
            return ['index' => $index + 1, 'C' => $item['C']];
        })->sortBy('C')->values();

        $availableKlasterIDs = Klaster::orderBy('id', 'asc')->pluck('id')->values();

        foreach ($finalCentroids as $i => $centroid) {
            $centroidToKlaster[$centroid['index']] = $availableKlasterIDs[$i];
        }

        foreach ($data as $item) {
            Curas::where('id', $item->id)->update([
                'klaster_id' => $centroidToKlaster[$item->temp_klaster],
            ]);
        }

        // Format centroid awal
        $centroidAwalFormatted = collect($centroidAwal)->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => $item['C']];
        });

        // Format centroid akhir
        $centroidAkhirFormatted = $centroids->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => $item['C']];
        });

        $hasilKMeansCuras = [
            'centroid_awal' => $centroidAwalFormatted,
            'centroid_akhir' => $centroidAkhirFormatted,
            'iterasi' => $iterasi
        ];

        file_put_contents(
            storage_path('app/public/hasil_kmeans_curas.json'),
            json_encode($hasilKMeansCuras, JSON_PRETTY_PRINT)
        );


        return redirect('/dashboard/TampilHitungCuras');

    }


    public function KMeansCuranmor()
    {
        $data = Curanmor::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curanmor')->orderBy('jumlah_curanmor', 'asc')->get();

        $maxIterasi = 100;

        $centroidManual = [10, 20, 30]; 
        $centroids = collect($centroidManual)->map(function ($value) {
            return ['C' => $value];
        });

        $centroidAwal = $centroids->toArray();

        $iterasi = [];
        $prevAssignment = [];

        for ($i = 0; $i < $maxIterasi; $i++) {
            $clustered = [];
            $currentAssignment = [];

            foreach ($data as $item) {
                $jarak = [];

                foreach ($centroids as $idx => $centroid) {
                    $dist = abs($item->jumlah_curanmor - $centroid['C']);
                    $jarak["C" . ($idx + 1)] = $dist;
                }

                $iterasi[$i][] = array_merge(['kecamatan_id' => $item->kecamatan_id], $jarak);

                $minIndex = array_keys($jarak, min($jarak))[0];
                $clusterNumber = (int) str_replace("C", "", $minIndex);

                $clustered[$clusterNumber][] = $item;
                $item->temp_klaster = $clusterNumber;
                $currentAssignment[$item->id] = $clusterNumber;
            }

            if ($currentAssignment === $prevAssignment) {
                break;
            }

            $prevAssignment = $currentAssignment;

            // Update centroid berdasarkan rata-rata
            foreach ($clustered as $key => $group) {
                $avg = collect($group)->avg('jumlah_curanmor');
                $centroids = $centroids->map(function ($item, $index) use ($key, $avg) {
                    return $index === ($key - 1)
                        ? ['C' => $avg]
                        : $item;
                });
            }
        }

        // Final mapping centroid ke klaster_id
        $finalCentroids = $centroids->map(function ($item, $index) {
            return ['index' => $index + 1, 'C' => $item['C']];
        })->sortBy('C')->values();

        $availableKlasterIDs = Klaster::orderBy('id', 'asc')->pluck('id')->values();

        foreach ($finalCentroids as $i => $centroid) {
            $centroidToKlaster[$centroid['index']] = $availableKlasterIDs[$i];
        }


        // Update ke database



        foreach ($data as $item) {
            Curanmor::where('id', $item->id)->update([
                'klaster_id' => $centroidToKlaster[$item->temp_klaster],
            ]);
        }

        // Format centroid awal
        $centroidAwalFormatted = collect($centroidAwal)->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => $item['C']];
        });

        // Format centroid akhir
        $centroidAkhirFormatted = $centroids->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => $item['C']];
        });

        $hasilKMeansCuranmor = [
            'centroid_awal' => $centroidAwalFormatted,
            'centroid_akhir' => $centroidAkhirFormatted,
            'iterasi' => $iterasi
        ];

        file_put_contents(
            storage_path('app/public/hasil_kmeans_curanmor.json'),
            json_encode($hasilKMeansCuranmor, JSON_PRETTY_PRINT)
        );


        return redirect('/dashboard/TampilHitungCuranmor');
    }

}
