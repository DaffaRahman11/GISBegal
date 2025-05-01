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

        $uniqueCount = $data->unique('jumlah_curas')->count();
        if ($uniqueCount < $k) {
            throw new \Exception("Jumlah nilai unik pada 'jumlah_curas' ($uniqueCount) kurang dari jumlah klaster ($k). Pastikan data memiliki variasi yang cukup.");
        }

        // Ambil centroid awal yang unik
        // Gunakan centroid tetap

        $centroidValues = [0, 1, 3];
        $centroids = collect($centroidValues)->map(function ($val) {
            return ['jumlah_curas' => $val];
        });

        // Simpan centroid awal sebelum iterasi
        $centroidAwal = $centroids->toArray();

        $iterasi = [];
        $prevAssignment = [];

        for ($i = 0; $i < $maxIterasi; $i++) {
            $clustered = [];
            $currentAssignment = [];

            foreach ($data as $item) {
                $jarak = [];

                foreach ($centroids as $idx => $centroid) {
                    $dist = abs($item->jumlah_curas - $centroid['jumlah_curas']);
                    $jarak["C" . ($idx + 1)] = $dist;
                }

                $iterasi[$i][] = array_merge(['kecamatan_id' => $item->kecamatan_id], $jarak);

                $minIndex = array_keys($jarak, min($jarak))[0]; // e.g. "jarakC2"
                $clusterNumber = (int) str_replace("C", "", $minIndex);

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


        $centroidAwalFormatted = collect($centroidAwal)->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => $item['jumlah_curas']];
        });
        

        $hasil = [
            'centroid_awal' => $centroidAwalFormatted,
            'iterasi' => $iterasi
        ];
        
        file_put_contents(
            storage_path('app/public/hasil_kmeans_curas.json'),
            json_encode($hasil, JSON_PRETTY_PRINT)
        );

        return redirect('/dashboard/TampilHitungCuras');
        
    }


    public function KMeansCuranmor()
    {
        $data = Curanmor::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curanmor')->orderBy('jumlah_curanmor', 'asc')->get();

        $k = Klaster::count('id');
        $maxIterasi = 100;

        $uniqueCount = $data->unique('jumlah_curanmor')->count();
        if ($uniqueCount < $k) {
            throw new \Exception("Jumlah nilai unik pada 'jumlah_curanmor' ($uniqueCount) kurang dari jumlah klaster ($k). Pastikan data memiliki variasi yang cukup.");
        }

        $centroidValues = [10, 20, 30];
        $centroids = collect($centroidValues)->map(function ($val) {
            return ['jumlah_curanmor' => $val];
        });

        // Simpan centroid awal sebelum iterasi
        $centroidAwal = $centroids->toArray();

        $iterasi = [];
        $prevAssignment = [];

        for ($i = 0; $i < $maxIterasi; $i++) {
            $clustered = [];
            $currentAssignment = [];

            foreach ($data as $item) {
                $jarak = [];

                foreach ($centroids as $idx => $centroid) {
                    $dist = abs($item->jumlah_curanmor - $centroid['jumlah_curanmor']);
                    $jarak["C" . ($idx + 1)] = $dist;
                }

                $iterasi[$i][] = array_merge(['kecamatan_id' => $item->kecamatan_id], $jarak);

                $minIndex = array_keys($jarak, min($jarak))[0]; // e.g. "jarakC2"
                $clusterNumber = (int) str_replace("C", "", $minIndex);

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
                $avg = collect($group)->avg('jumlah_curanmor');
                $centroids = $centroids->map(function ($item, $index) use ($key, $avg) {
                    return $index === ($key - 1)
                        ? ['jumlah_curanmor' => $avg]
                        : $item;
                });
            }
        }
        

        // Final mapping centroid ke klaster_id (aman/sedang/rawan)
        $finalCentroids = $centroids->map(function ($item, $index) {
            return ['index' => $index + 1, 'jumlah_curanmor' => $item['jumlah_curanmor']];
        })->sortBy('jumlah_curanmor')->values();

        $centroidToKlaster = [];

        foreach ($finalCentroids as $i => $centroid) {
            // Klaster ID mulai dari 1 (asumsi klaster di DB bernomor 1, 2, 3, ...)
            $centroidToKlaster[$centroid['index']] = $i + 1;
        }


        // Update ke database
        foreach ($data as $item) {
            Curanmor::where('id', $item->id)->update([
                'klaster_id' => $centroidToKlaster[$item->temp_klaster],
            ]);
        }


        $centroidAwalFormatted = collect($centroidAwal)->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => $item['jumlah_curanmor']];
        });
        
        $hasil = [
            'centroid_awal' => $centroidAwalFormatted,
            'iterasi' => $iterasi
        ];
        
        file_put_contents(
            storage_path('app/public/hasil_kmeans_curanmor.json'),
            json_encode($hasil, JSON_PRETTY_PRINT)
        );

        return redirect('/dashboard/TampilHitungCuranmor');
        
    }

}
