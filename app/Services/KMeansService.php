<?php

namespace App\Services;

use App\Models\Curas;
use App\Models\Klaster;
use App\Models\Curanmor;


class KMeansService
{
    public function hitungKMeansCuras()
    {
        $data = Curas::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curas')->orderBy('jumlah_curas', 'asc')->get();
        $k = Klaster::count('id');
        $maxIterasi = 100;

        // Ambil centroid awal yang unik
        $minValue = $data->min('jumlah_curas');
        $maxValue = $data->max('jumlah_curas');

        $generated = collect();
        while ($generated->count() < $k) {
            $random = mt_rand($minValue, $maxValue); 
            if (!$generated->contains($random)) {
                $generated->push($random);
            }
        }

        $centroids = $generated->map(function ($value) {
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


        // Update ke database



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

        return [
            'centroid_awal' => $centroidAwalFormatted,
            'centroid_akhir' => $centroidAkhirFormatted,
            'iterasi' => $iterasi
        ];
    }

    public function hitungKMeansCuranmor()
    {
        $data = Curanmor::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curanmor')->orderBy('jumlah_curanmor', 'asc')->get();

        $k = Klaster::count('id');
        $maxIterasi = 100;

        // Ambil centroid awal yang unik
        $minValue = $data->min('jumlah_curanmor');
        $maxValue = $data->max('jumlah_curanmor');

        $generated = collect();
        while ($generated->count() < $k) {
            $random = mt_rand($minValue, $maxValue); 
            if (!$generated->contains($random)) {
                $generated->push($random);
            }
        }

        $centroids = $generated->map(function ($value) {
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

        return [
            'centroid_awal' => $centroidAwalFormatted,
            'centroid_akhir' => $centroidAkhirFormatted,
            'iterasi' => $iterasi
        ];
    }

     public function SSEElbowCuranmor()
    {
        $data = Curanmor::select('id', 'jumlah_curanmor')->get();
        $maxK = 10;
        $maxIterasi = 100;
        $elbowData = [];

        $min = $data->min('jumlah_curanmor');
        $max = $data->max('jumlah_curanmor');

        // Loop untuk setiap nilai k dari 2 hingga maxK
        for ($k = 2; $k <= $maxK; $k++) {
            $centroids = collect(range(1, $k))->map(function () use ($min, $max) {
                return ['jumlah_curanmor' => mt_rand($min, $max)];
            });

            $prevAssignment = [];

            for ($iter = 0; $iter < $maxIterasi; $iter++) {
                $clustered = [];
                $currentAssignment = [];

                foreach ($data as $item) {
                    $jarak = [];

                    // Hitung jarak antara data dan setiap centroid
                    foreach ($centroids as $idx => $centroid) {
                        $dist = abs($item->jumlah_curanmor - $centroid['jumlah_curanmor']);
                        $jarak[$idx] = $dist;
                    }

                    // Tentukan cluster dengan jarak terdekat
                    $minIndex = array_keys($jarak, min($jarak))[0];
                    $clustered[$minIndex][] = $item;
                    $currentAssignment[$item->id] = $minIndex;
                }

                // Jika tidak ada perubahan cluster, break
                if ($currentAssignment === $prevAssignment) {
                    break;
                }

                $prevAssignment = $currentAssignment;

                // Update centroid dengan rata-rata cluster
                foreach ($clustered as $key => $group) {
                    $avg = collect($group)->avg('jumlah_curanmor');
                    $centroids = $centroids->map(function ($centroid, $idx) use ($key, $avg) {
                        return $idx == $key
                            ? ['jumlah_curanmor' => $avg]
                            : $centroid;
                    });
                }
            }

            // Hitung SSE (Sum of Squared Errors)
            $sse = 0;
            foreach ($clustered as $key => $group) {
                $centroidVal = $centroids[$key]['jumlah_curanmor'];
                foreach ($group as $item) {
                    $sse += pow($item->jumlah_curanmor - $centroidVal, 2);
                }
            }

            // Simpan SSE untuk nilai k
            $elbowData[] = [
                'k' => $k,
                'sse' => round($sse, 4)
            ];
        }

        // Simpan hasil SSE untuk setiap k ke file JSON
        file_put_contents(
            storage_path('app/public/sse_elbow_curanmor.json'),
            json_encode($elbowData, JSON_PRETTY_PRINT)
        );
    }

    public function SSEElbowCuras()
    {
        $data = Curas::select('id', 'jumlah_curas')->get();
        $maxK = 10;
        $maxIterasi = 100;
        $elbowData = [];

        $min = $data->min('jumlah_curas');
        $max = $data->max('jumlah_curas');

        // Loop untuk setiap nilai k dari 2 hingga maxK
        for ($k = 2; $k <= $maxK; $k++) {
            $centroids = collect(range(1, $k))->map(function () use ($min, $max) {
                return ['jumlah_curas' => mt_rand($min, $max)];
            });

            $prevAssignment = [];

            for ($iter = 0; $iter < $maxIterasi; $iter++) {
                $clustered = [];
                $currentAssignment = [];

                foreach ($data as $item) {
                    $jarak = [];

                    // Hitung jarak antara data dan setiap centroid
                    foreach ($centroids as $idx => $centroid) {
                        $dist = abs($item->jumlah_curas - $centroid['jumlah_curas']);
                        $jarak[$idx] = $dist;
                    }

                    // Tentukan cluster dengan jarak terdekat
                    $minIndex = array_keys($jarak, min($jarak))[0];
                    $clustered[$minIndex][] = $item;
                    $currentAssignment[$item->id] = $minIndex;
                }

                // Jika tidak ada perubahan cluster, break
                if ($currentAssignment === $prevAssignment) {
                    break;
                }

                $prevAssignment = $currentAssignment;

                // Update centroid dengan rata-rata cluster
                foreach ($clustered as $key => $group) {
                    $avg = collect($group)->avg('jumlah_curas');
                    $centroids = $centroids->map(function ($centroid, $idx) use ($key, $avg) {
                        return $idx == $key
                            ? ['jumlah_curas' => $avg]
                            : $centroid;
                    });
                }
            }

            // Hitung SSE (Sum of Squared Errors)
            $sse = 0;
            foreach ($clustered as $key => $group) {
                $centroidVal = $centroids[$key]['jumlah_curas'];
                foreach ($group as $item) {
                    $sse += pow($item->jumlah_curas - $centroidVal, 2);
                }
            }

            // Simpan SSE untuk nilai k
            $elbowData[] = [
                'k' => $k,
                'sse' => round($sse, 4)
            ];
        }

        // Simpan hasil SSE untuk setiap k ke file JSON
        file_put_contents(
            storage_path('app/public/sse_elbow_curas.json'),
            json_encode($elbowData, JSON_PRETTY_PRINT)
        );
    }





}
