<?php

namespace App\Services;

use App\Models\Curas;
use App\Models\Klaster;
use App\Models\Curanmor;
use Illuminate\Support\Facades\Storage;


class KMeansService
{
    public function hitungKMeansCuras()
    {
        $data = Curas::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curas')->orderBy('jumlah_curas', 'asc')->get();
        $k = Klaster::count('id');
        $maxIterasi = 100;

        // Hitung min dan max untuk normalisasi
        $minValue = $data->min('jumlah_curas');
        $maxValue = $data->max('jumlah_curas');

        // Normalisasi data dan simpan hasilnya ke dalam array baru
        $normalizedData = $data->map(function ($item) use ($minValue, $maxValue) {
            $normalized = ($item->jumlah_curas - $minValue) / ($maxValue - $minValue);
            $item->normalized_curas = round($normalized, 2); // 2 angka di belakang koma
            return $item;
        });

        // Inisialisasi centroid dengan nilai acak dari rentang normalisasi [0, 1]
        $generated = collect();
        while ($generated->count() < $k) {
            $random = round(mt_rand(0, 100) / 100, 2); // Random 0.00–1.00
            if (!$generated->contains($random)) {
                $generated->push($random);
            }
        }

        $centroids = $generated->map(fn($value) => ['C' => $value]);
        $centroidAwal = $centroids->toArray();

        $iterasi = [];
        $prevAssignment = [];

        for ($i = 0; $i < $maxIterasi; $i++) {
            $clustered = [];
            $currentAssignment = [];

            foreach ($normalizedData as $item) {
                $jarak = [];

                foreach ($centroids as $idx => $centroid) {
                    $dist = abs($item->normalized_curas - $centroid['C']);
                    $jarak["C" . ($idx + 1)] = round($dist, 2); // Format 2 angka koma
                }

                $minIndex = array_keys($jarak, min($jarak))[0];
                $clusterNumber = (int) str_replace("C", "", $minIndex);

                $clustered[$clusterNumber][] = $item;
                $item->temp_klaster = $clusterNumber;
                $currentAssignment[$item->id] = $clusterNumber;

                // Tambahkan nilai normalisasi ke dalam iterasi
                $iterasi[$i][] = array_merge(
                    ['kecamatan_id' => $item->kecamatan_id],
                    ['normal' => round($item->normalized_curas, 2)],
                    $jarak
                );
            }

            if ($currentAssignment === $prevAssignment) {
                break;
            }

            $prevAssignment = $currentAssignment;

            // Update centroid
            foreach ($clustered as $key => $group) {
                $avg = collect($group)->avg('normalized_curas');
                $avg = round($avg, 2); // Format 2 angka koma
                $centroids = $centroids->map(function ($item, $index) use ($key, $avg) {
                    return $index === ($key - 1)
                        ? ['C' => $avg]
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

        // Update ke database
        foreach ($data as $item) {
            Curas::where('id', $item->id)->update([
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

        // Simpan hasil ke file JSON (opsional)
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

        // Hitung min dan max untuk normalisasi
        $minValue = $data->min('jumlah_curanmor');
        $maxValue = $data->max('jumlah_curanmor');

        // Normalisasi data dan simpan hasilnya ke dalam property baru
        $normalizedData = $data->map(function ($item) use ($minValue, $maxValue) {
            $normalized = ($maxValue - $minValue) == 0 ? 0 : ($item->jumlah_curanmor - $minValue) / ($maxValue - $minValue);
            $item->normalized_curanmor = round($normalized, 2);
            return $item;
        });

        // Generate centroid awal unik dari data ter-normalisasi
        $generated = collect();
        while ($generated->count() < $k) {
            $rand = mt_rand(0, 100) / 100; // antara 0 dan 1 dengan 2 desimal
            $rand = round($rand, 2);
            if (!$generated->contains($rand)) {
                $generated->push($rand);
            }
        }

        $centroids = $generated->map(fn($val) => ['C' => $val]);
        $centroidAwal = $centroids->toArray();

        $iterasi = [];
        $prevAssignment = [];

        for ($i = 0; $i < $maxIterasi; $i++) {
            $clustered = [];
            $currentAssignment = [];

            foreach ($normalizedData as $item) {
                $jarak = [];

                foreach ($centroids as $idx => $centroid) {
                    $dist = abs($item->normalized_curanmor - $centroid['C']);
                    $jarak["C" . ($idx + 1)] = round($dist, 2);
                }

                // Tambahkan data ke iterasi, termasuk nilai normalisasi
                $iterasi[$i][] = array_merge(
                    ['kecamatan_id' => $item->kecamatan_id],
                    ['normal' => $item->normalized_curanmor], // tampilkan nilai normalisasi
                    $jarak
                );

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

            // Update centroid berdasarkan rata-rata normalisasi
            foreach ($clustered as $key => $group) {
                $avg = collect($group)->avg('normalized_curanmor');
                $avg = round($avg, 2);
                $centroids = $centroids->map(function ($item, $index) use ($key, $avg) {
                    return $index === ($key - 1)
                        ? ['C' => $avg]
                        : $item;
                });
            }
        }

        // Final mapping centroid ke klaster_id
        $finalCentroids = $centroids->map(function ($item, $index) {
            return ['index' => $index + 1, 'C' => round($item['C'], 2)];
        })->sortBy('C')->values();

        $availableKlasterIDs = Klaster::orderBy('id', 'asc')->pluck('id')->values();
        $centroidToKlaster = [];

        foreach ($finalCentroids as $i => $centroid) {
            $centroidToKlaster[$centroid['index']] = $availableKlasterIDs[$i];
        }

        // Update database
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

        return [
            'centroid_awal' => $centroidAwalFormatted,
            'centroid_akhir' => $centroidAkhirFormatted,
            'iterasi' => $iterasi
        ];
    }


    public function SSEElbowCuranmor()
    {
        $data = Curanmor::select('id', 'jumlah_curanmor')->get();
        $maxK = 15;
        $maxIterasi = 100;
        $elbowData = [];

        $min = $data->min('jumlah_curanmor');
        $max = $data->max('jumlah_curanmor');

        // Normalisasi jumlah_curanmor
        $normalizedData = $data->map(function ($item) use ($min, $max) {
            $item->normalized = ($max - $min) == 0 ? 0 : round(($item->jumlah_curanmor - $min) / ($max - $min), 2);
            return $item;
        });

        for ($k = 2; $k <= $maxK; $k++) {
            $usedValues = [];
            $centroids = collect();

            // Inisialisasi centroid secara acak dari nilai 0 sampai 1 dengan 2 desimal
            while ($centroids->count() < $k) {
                $randVal = round(mt_rand(0, 10000) / 10000, 2); // 2 angka desimal
                if (!in_array($randVal, $usedValues)) {
                    $centroids->push(['normalized' => $randVal]);
                    $usedValues[] = $randVal;
                }
            }

            $prevAssignment = [];

            for ($iter = 0; $iter < $maxIterasi; $iter++) {
                $clustered = [];
                $currentAssignment = [];

                foreach ($normalizedData as $item) {
                    $jarak = [];

                    foreach ($centroids as $idx => $centroid) {
                        $dist = abs($item->normalized - $centroid['normalized']);
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
                    $avg = round(collect($group)->avg('normalized'), 2); // 2 angka desimal
                    $centroids = $centroids->map(function ($centroid, $idx) use ($key, $avg) {
                        return $idx == $key
                            ? ['normalized' => $avg]
                            : $centroid;
                    });
                }
            }

            // Hitung SSE
            $sse = 0;
            foreach ($clustered as $key => $group) {
                $centroidVal = $centroids[$key]['normalized'];
                foreach ($group as $item) {
                    $sse += pow($item->normalized - $centroidVal, 2);
                }
            }

            $elbowData[] = [
                'k' => $k,
                'sse' => round($sse, 2) // 2 angka desimal
            ];
        }

        file_put_contents(
            storage_path('app/public/sse_elbow_curanmor.json'),
            json_encode($elbowData, JSON_PRETTY_PRINT)
        );
    }


    public function SSEElbowCuras()
    {
        $data = Curas::select('id', 'jumlah_curas')->get();
        $maxK = 4;
        $maxIterasi = 100;
        $elbowData = [];

        $min = $data->min('jumlah_curas');
        $max = $data->max('jumlah_curas');

        // Normalisasi nilai jumlah_curas
        $normalizedData = $data->map(function ($item) use ($min, $max) {
            $item->normalized = ($max - $min) == 0 ? 0 : round(($item->jumlah_curas - $min) / ($max - $min), 2);
            return $item;
        });

        for ($k = 2; $k <= $maxK; $k++) {
            $usedValues = [];
            $centroids = collect();

            // Inisialisasi centroid secara acak dari nilai 0 sampai 1 dengan 2 desimal
            while ($centroids->count() < $k) {
                $randVal = round(mt_rand(0, 10000) / 10000, 2); // 0.00 - 1.00
                if (!in_array($randVal, $usedValues)) {
                    $centroids->push(['normalized' => $randVal]);
                    $usedValues[] = $randVal;
                }
            }

            $prevAssignment = [];

            for ($iter = 0; $iter < $maxIterasi; $iter++) {
                $clustered = [];
                $currentAssignment = [];

                foreach ($normalizedData as $item) {
                    $jarak = [];

                    // Hitung jarak absolut (Manhattan Distance)
                    foreach ($centroids as $idx => $centroid) {
                        $dist = abs($item->normalized - $centroid['normalized']);
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
                    $avg = round(collect($group)->avg('normalized'), 2);
                    $centroids = $centroids->map(function ($centroid, $idx) use ($key, $avg) {
                        return $idx == $key
                            ? ['normalized' => $avg]
                            : $centroid;
                    });
                }
            }

            // Hitung SSE
            $sse = 0;
            foreach ($clustered as $key => $group) {
                $centroidVal = $centroids[$key]['normalized'];
                foreach ($group as $item) {
                    $sse += pow($item->normalized - $centroidVal, 2);
                }
            }

            $elbowData[] = [
                'k' => $k,
                'sse' => round($sse, 2) // dibulatkan ke 2 desimal
            ];
        }

        file_put_contents(
            storage_path('app/public/sse_elbow_curas.json'),
            json_encode($elbowData, JSON_PRETTY_PRINT)
        );
    }


    public function hitungDBSCANManual()
    {
        $eps = 1.5; // Jarak maksimum antar titik
        $minPts = 3; // Minimum tetangga agar jadi core point

        $data = Curas::select('jumlah_curas')->get()->pluck('jumlah_curas')->map(fn($v) => (float)$v)->toArray();
        $n = count($data);

        $visited = array_fill(0, $n, false);
        $labels = array_fill(0, $n, null);
        $clusterId = 0;

        // Fungsi cari tetangga
        $regionQuery = function ($pointIndex) use ($data, $eps) {
            $neighbors = [];
            foreach ($data as $i => $val) {
                if (abs($val - $data[$pointIndex]) <= $eps) {
                    $neighbors[] = $i;
                }
            }
            return $neighbors;
        };

        // DBSCAN Proses
        for ($i = 0; $i < $n; $i++) {
            if ($visited[$i]) continue;
            $visited[$i] = true;

            $neighbors = $regionQuery($i);
            if (count($neighbors) < $minPts) {
                $labels[$i] = -1; // noise
                continue;
            }

            $labels[$i] = $clusterId;
            $seeds = array_diff($neighbors, [$i]);

            foreach ($seeds as $seed) {
                if (!$visited[$seed]) {
                    $visited[$seed] = true;
                    $newNeighbors = $regionQuery($seed);
                    if (count($newNeighbors) >= $minPts) {
                        $seeds = array_unique(array_merge($seeds, $newNeighbors));
                    }
                }

                if ($labels[$seed] === null || $labels[$seed] === -1) {
                    $labels[$seed] = $clusterId;
                }
            }

            $clusterId++;
        }

        // Hitung silhouette (manual satu dimensi)
        $silhouetteScores = [];
        foreach ($data as $i => $val) {
            $label = $labels[$i];
            if ($label === -1) continue; // skip noise

            $sameCluster = [];
            $otherClusters = [];

            foreach ($data as $j => $otherVal) {
                if ($i === $j || $labels[$j] === -1) continue;
                if ($labels[$j] === $label) {
                    $sameCluster[] = abs($val - $otherVal);
                } else {
                    $otherClusters[$labels[$j]][] = abs($val - $otherVal);
                }
            }

            $a = count($sameCluster) > 0 ? array_sum($sameCluster) / count($sameCluster) : 0;
            $b = count($otherClusters) > 0 ? min(array_map(fn($d) => array_sum($d) / count($d), $otherClusters)) : 0;

            $s = ($a === $b && $a === 0) ? 0 : ($b - $a) / max($a, $b);
            $silhouetteScores[] = $s;
        }

        $meanSilhouette = count($silhouetteScores) > 0 ? round(array_sum($silhouetteScores) / count($silhouetteScores), 4) : 0;

        // Susun hasil anggota klaster
        $anggotaKlaster = [];
        foreach ($labels as $i => $label) {
            $anggotaKlaster[$label][] = $data[$i];
        }

        $jumlahKlaster = count(array_filter(array_keys($anggotaKlaster), fn($k) => $k !== -1));

        $hasil = [
            'silhouette' => $meanSilhouette,
            'jumlah_klaster' => $jumlahKlaster,
            'anggota_klaster' => $anggotaKlaster,
        ];

        file_put_contents(
            storage_path('app/public/dbscan_curas.json'),
            json_encode($hasil, JSON_PRETTY_PRINT)
        );
        return $hasil;
    }

    public function kmeansWithSilhouetteSingleMethod(int $k = 2, int $maxIter = 100): array
    {
        // Ambil data dari tabel curas
        $data = \App\Models\Curas::select('kecamatan_id', 'jumlah_curas')
            ->get()
            ->pluck('jumlah_curas', 'kecamatan_id')
            ->toArray();

        $ids = array_keys($data);
        $values = array_values($data);

        // Inisialisasi centroid secara random
        // Ambil nilai min dan max dari data
        $minValue = min($values);
        $maxValue = max($values);

        $centroids = [];

        if ($k == 1) {
            // Jika cuma 1 klaster, centroid random antara min dan max
            $centroids[] = rand($minValue, $maxValue);
        } else {
            // Untuk k >= 2, inisialisasi centroid unik integer dalam rentang min-max
            $centroids = [];
            while (count($centroids) < $k) {
                $randCentroid = rand($minValue, $maxValue);
                if (!in_array($randCentroid, $centroids)) {
                    $centroids[] = $randCentroid;
                }
            }
        }


        $clusters = [];
        $iter = 0;

        do {
            $clusters = array_fill(0, $k, []);

            // Assign ke klaster terdekat (jarak absolut 1 dimensi)
            foreach ($values as $idx => $val) {
                $distances = [];
                foreach ($centroids as $cidx => $centroid) {
                    $distances[$cidx] = abs($val - $centroid);
                }
                asort($distances);
                $nearestCluster = key($distances);
                $clusters[$nearestCluster][] = $idx;
            }

            // Hitung centroid baru
            $newCentroids = [];
            foreach ($clusters as $cluster) {
                if (count($cluster) > 0) {
                    $sum = 0;
                    foreach ($cluster as $i) {
                        $sum += $values[$i];
                    }
                    $newCentroids[] = $sum / count($cluster);
                } else {
                    // Jika cluster kosong, pilih centroid random
                    $newCentroids[] = $values[array_rand($values)];
                }
            }

            $iter++;
            if ($newCentroids === $centroids) break;
            if ($iter >= $maxIter) break;
            $centroids = $newCentroids;

        } while (true);

        // Fungsi hitung rata-rata jarak
        $avgDistance = function(int $i, array $cluster) use ($values): float {
            if (count($cluster) <= 1) return 0;
            $sum = 0;
            foreach ($cluster as $idx) {
                if ($idx == $i) continue;
                $sum += abs($values[$i] - $values[$idx]);
            }
            return $sum / (count($cluster) - 1);
        };

        // Hitung silhouette untuk setiap data
        $silhouetteScores = [];
        for ($i = 0; $i < count($values); $i++) {
            // Cari klaster data ke-i
            $clusterIdx = null;
            foreach ($clusters as $cidx => $cluster) {
                if (in_array($i, $cluster)) {
                    $clusterIdx = $cidx;
                    break;
                }
            }

            $a = $avgDistance($i, $clusters[$clusterIdx]);
            $b = INF;
            foreach ($clusters as $cidx => $cluster) {
                if ($cidx == $clusterIdx) continue;
                $dist = $avgDistance($i, $cluster);
                if ($dist < $b) $b = $dist;
            }

            $silhouetteScores[] = ($b - $a) / max($a, $b);
        }

        $silhouette = array_sum($silhouetteScores) / count($silhouetteScores);

        // Bentuk output anggota klaster dengan kecamatan_id
        $clusterMembers = [];
        foreach ($clusters as $cidx => $cluster) {
            $clusterMembers[$cidx] = [];
            foreach ($cluster as $idx) {
                $clusterMembers[$cidx][] = $ids[$idx];
            }
        }

        $hasil = [
            'silhouette' => $silhouette,
            'jumlah_klaster' => $k,
            'anggota_klaster' => $clusterMembers,
            'iterasi' => $iter,
            'centroid' => $centroids,
        ];

        // Simpan ke file JSON
        file_put_contents(
            storage_path('app/public/silhoute_kmeans_curas.json'),
            json_encode($hasil, JSON_PRETTY_PRINT)
        );

        return $hasil;
    }






}
