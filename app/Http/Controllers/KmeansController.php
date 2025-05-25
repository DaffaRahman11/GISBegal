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
        $data = Curas::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curas')
            ->orderBy('kecamatan_id', 'asc')->get();

        // Hitung min dan max untuk normalisasi
        $min = $data->min('jumlah_curas');
        $max = $data->max('jumlah_curas');

        // Normalisasi jumlah_curas ke skala 0–1
        $data = $data->map(function ($item) use ($min, $max) {
            $item->jumlah_curas_normalized = $max == $min
                ? 1
                : round(($item->jumlah_curas - $min) / ($max - $min), 2);
            return $item;
        });

        $maxIterasi = 100;

        // Centroid awal langsung dalam skala 0–1
        $centroidManual = [0.0, 0.5, 1];
        $centroids = collect($centroidManual)->map(function ($value) {
            return ['C' => round($value, 2)];
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
                    $dist = abs($item->jumlah_curas_normalized - $centroid['C']);
                    $jarak["C" . ($idx + 1)] = round($dist, 2);
                }

                $iterasi[$i][] = array_merge([
                    'kecamatan_id' => $item->kecamatan_id,
                    'normal' => round($item->jumlah_curas_normalized, 2)
                ], $jarak);

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

            // Update centroid dengan rata-rata nilai normalized
            foreach ($clustered as $key => $group) {
                $avg = collect($group)->avg('jumlah_curas_normalized');
                $centroids = $centroids->map(function ($item, $index) use ($key, $avg) {
                    return $index === ($key - 1)
                        ? ['C' => round($avg, 2)]
                        : $item;
                });
            }
        }

        // Mapping centroid ke klaster_id
        $finalCentroids = $centroids->map(function ($item, $index) {
            return ['index' => $index + 1, 'C' => round($item['C'], 2)];
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

        $centroidAwalFormatted = collect($centroidAwal)->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => round($item['C'], 2)];
        });

        $centroidAkhirFormatted = $centroids->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => round($item['C'], 2)];
        });

        $hasilKMeansCuras = [
            'centroid_awal' => $centroidAwalFormatted,
            'centroid_akhir' => $centroidAkhirFormatted,
            'iterasi' => $iterasi,
            'min' => $min,
            'max' => $max
        ];

        file_put_contents(
            storage_path('app/public/hasil_kmeans_curas.json'),
            json_encode($hasilKMeansCuras, JSON_PRETTY_PRINT)
        );

        return redirect('/dashboard/TampilHitungCuras');
    }


    public function KMeansCuranmor()
    {
        // Ambil data awal
        $data = Curanmor::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curanmor')
            ->orderBy('kecamatan_id', 'asc')->get();

        // Hitung min dan max untuk normalisasi Min-Max
        $min = $data->min('jumlah_curanmor');
        $max = $data->max('jumlah_curanmor');

        // Normalisasi jumlah_curanmor ke skala 1-100
        $data = $data->map(function ($item) use ($min, $max) {
            $item->jumlah_curanmor_normalized = $max == $min 
                ? 1 
                : round((($item->jumlah_curanmor - $min) / ($max - $min)), 2);
            return $item;
        });

        $maxIterasi = 100;

        // Centroid awal dalam skala 1–100
        $centroidManual = [0.2, 0.5, 0.8];
        $centroids = collect($centroidManual)->map(function ($value) {
            return ['C' => round($value, 2)];
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
                    $dist = abs($item->jumlah_curanmor_normalized - $centroid['C']);
                    $jarak["C" . ($idx + 1)] = round($dist, 2); // Dua angka di belakang koma
                }

                $iterasi[$i][] = array_merge([
                    'kecamatan_id' => $item->kecamatan_id,
                    'normal' => round($item->jumlah_curanmor_normalized, 2)
                ], $jarak);

                $minIndex = array_keys($jarak, min($jarak))[0];
                $clusterNumber = (int) str_replace("C", "", $minIndex);

                $clustered[$clusterNumber][] = $item;
                $item->temp_klaster = $clusterNumber;
                $currentAssignment[$item->id] = $clusterNumber;
            }

            // Cek konvergensi
            if ($currentAssignment === $prevAssignment) {
                break;
            }

            $prevAssignment = $currentAssignment;

            // Update centroid berdasarkan rata-rata nilai yang sudah dinormalisasi
            foreach ($clustered as $key => $group) {
                $avg = collect($group)->avg('jumlah_curanmor_normalized');
                $centroids = $centroids->map(function ($item, $index) use ($key, $avg) {
                    return $index === ($key - 1)
                        ? ['C' => round($avg, 2)]
                        : $item;
                });
            }
        }

        // Final mapping centroid ke klaster_id
        $finalCentroids = $centroids->map(function ($item, $index) {
            return ['index' => $index + 1, 'C' => round($item['C'], 2)];
        })->sortBy('C')->values();

        $availableKlasterIDs = Klaster::orderBy('id', 'asc')->pluck('id')->values();

        foreach ($finalCentroids as $i => $centroid) {
            $centroidToKlaster[$centroid['index']] = $availableKlasterIDs[$i];
        }

        // Update hasil clustering ke database
        foreach ($data as $item) {
            Curanmor::where('id', $item->id)->update([
                'klaster_id' => $centroidToKlaster[$item->temp_klaster],
            ]);
        }

        // Format centroid awal
        $centroidAwalFormatted = collect($centroidAwal)->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => round($item['C'], 2)];
        });

        // Format centroid akhir
        $centroidAkhirFormatted = $centroids->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => round($item['C'], 2)];
        });

        $hasilKMeansCuranmor = [
            'centroid_awal' => $centroidAwalFormatted,
            'centroid_akhir' => $centroidAkhirFormatted,
            'iterasi' => $iterasi,
            'min' => $min,
            'max' => $max
        ];

        file_put_contents(
            storage_path('app/public/hasil_kmeans_curanmor.json'),
            json_encode($hasilKMeansCuranmor, JSON_PRETTY_PRINT)
        );

        return redirect('/dashboard/TampilHitungCuranmor');
    }




}
