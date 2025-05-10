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
            $randomFloat = round(mt_rand($minValue * 100, $maxValue * 100) / 100, 2); 
            if (!$generated->contains($randomFloat)) {
                $generated->push($randomFloat);
            }
        }

        $centroids = $generated->map(function ($value) {
            return ['jumlah_curas' => $value];
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
                    $dist = abs($item->jumlah_curas - $centroid['jumlah_curas']);
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
                        ? ['jumlah_curas' => $avg]
                        : $item;
                });
            }
        }

        // Final mapping centroid ke klaster_id
        $finalCentroids = $centroids->map(function ($item, $index) {
            return ['index' => $index + 1, 'jumlah_curas' => $item['jumlah_curas']];
        })->sortBy('jumlah_curas')->values();

        $centroidToKlaster = [];
        foreach ($finalCentroids as $i => $centroid) {
            $centroidToKlaster[$centroid['index']] = $i + 1;
        }

        // Update ke database
        foreach ($data as $item) {
            Curas::where('id', $item->id)->update([
                'klaster_id' => $centroidToKlaster[$item->temp_klaster],
            ]);
        }

        // Format centroid awal
        $centroidAwalFormatted = collect($centroidAwal)->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => $item['jumlah_curas']];
        });

        // Format centroid akhir
        $centroidAkhirFormatted = $centroids->values()->map(function ($item, $index) {
            return ['C' . ($index + 1) => $item['jumlah_curas']];
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

        $minValue = $data->min('jumlah_curanmor');
        $maxValue = $data->max('jumlah_curanmor');

        $generated = collect();
        while ($generated->count() < $k) {
            $randomFloat = round(mt_rand($minValue * 100, $maxValue * 100) / 100, 2); 
            if (!$generated->contains($randomFloat)) {
                $generated->push($randomFloat);
            }
        }

        $centroids = $generated->map(function ($value) {
            return ['jumlah_curanmor' => $value];
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
        
        return [
            'centroid_awal' => $centroidAwalFormatted,
            'iterasi' => $iterasi
        ];
        
    }

    public function SSEElbowCuras()
    {
        $data = Curas::select('id', 'jumlah_curas')->get();
        $maxK = 10;
        $maxIterasi = 100;
        $elbowData = [];

        // Ambil nilai minimum dan maksimum dari jumlah_curas
        $min = $data->min('jumlah_curas');
        $max = $data->max('jumlah_curas');

        for ($k = 2; $k <= $maxK; $k++) {
            // Inisialisasi centroid awal sebagai float acak dalam rentang min-max
            $centroids = collect(range(1, $k))->map(function () use ($min, $max) {
                return ['jumlah_curas' => mt_rand($min * 100, $max * 100) / 100];
            });

            $centroidAwal = $centroids->pluck('jumlah_curas')->toArray();
            $prevAssignment = [];

            for ($iter = 0; $iter < $maxIterasi; $iter++) {
                $clustered = [];
                $currentAssignment = [];

                foreach ($data as $item) {
                    $jarak = [];

                    foreach ($centroids as $idx => $centroid) {
                        $dist = abs($item->jumlah_curas - $centroid['jumlah_curas']);
                        $jarak[$idx] = $dist;
                    }

                    $minIndex = array_keys($jarak, min($jarak))[0];
                    $clustered[$minIndex][] = $item;
                    $currentAssignment[$item->id] = $minIndex;
                }

                if ($currentAssignment === $prevAssignment) {
                    break;
                }

                $prevAssignment = $currentAssignment;

                foreach ($clustered as $key => $group) {
                    $avg = collect($group)->avg('jumlah_curas');
                    $centroids = $centroids->map(function ($centroid, $idx) use ($key, $avg) {
                        return $idx == $key
                            ? ['jumlah_curas' => $avg]
                            : $centroid;
                    });
                }
            }

            // Hitung SSE
            $sse = 0;
            foreach ($clustered as $key => $group) {
                $centroidVal = $centroids[$key]['jumlah_curas'];
                foreach ($group as $item) {
                    $sse += pow($item->jumlah_curas - $centroidVal, 2);
                }
            }

            $elbowData[] = [
                'k' => $k,
                'sse' => $sse,
                'centroid_awal' => $centroidAwal
            ];
        }

        

        file_put_contents(
            storage_path('app/public/sse_elbow_curas.json'),
            json_encode($elbowData, JSON_PRETTY_PRINT)
        );
    }

    

    public function SSEElbowCuranmor()
    {
        $data = Curanmor::select('id', 'jumlah_curanmor')->get();
        $maxK = 10;
        $maxIterasi = 100;
        $elbowData = [];
    
        for ($k = 2; $k <= $maxK; $k++) {
            // Inisialisasi centroid awal secara acak
            $centroids = $data->unique('jumlah_curanmor')->shuffle()->take($k)->values()->map(function ($item) {
                return ['jumlah_curanmor' => $item->jumlah_curanmor];
            });
    
            // Simpan centroid awal sebagai array angka
            $centroidAwal = $centroids->pluck('jumlah_curanmor')->toArray();
    
            $prevAssignment = [];
    
            for ($iter = 0; $iter < $maxIterasi; $iter++) {
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
                }
    
                if ($currentAssignment === $prevAssignment) {
                    break;
                }
    
                $prevAssignment = $currentAssignment;
    
                // Update centroid
                foreach ($clustered as $key => $group) {
                    $avg = collect($group)->avg('jumlah_curanmor');
                    $centroids = $centroids->map(function ($centroid, $idx) use ($key, $avg) {
                        return $idx == $key
                            ? ['jumlah_curanmor' => $avg]
                            : $centroid;
                    });
                }
            }
    
            // Hitung SSE untuk k saat ini
            $sse = 0;
            foreach ($clustered as $key => $group) {
                $centroidVal = $centroids[$key]['jumlah_curanmor'];
                foreach ($group as $item) {
                    $sse += pow($item->jumlah_curanmor - $centroidVal, 2);
                }
            }
    
            $elbowData[] = [
                'k' => $k,
                'sse' => $sse,
                'centroid_awal' => $centroidAwal
            ];
        }
    
        // Simpan ke file
        file_put_contents(
            storage_path('app/public/sse_elbow_curanmor.json'),
            json_encode($elbowData, JSON_PRETTY_PRINT)
        );
    }

}
