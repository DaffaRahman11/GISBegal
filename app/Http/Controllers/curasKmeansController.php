<?php

namespace App\Http\Controllers;

use App\Models\Curas;
use Illuminate\Http\Request;

class curasKmeansController extends Controller
{
    public function hitungKMeans()
    {
    $data = Curas::select('id', 'kecamatan_id', 'klaster_id', 'jumlah_curas')->orderBy('jumlah_curas', 'asc')->get();

    $k = 3;
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

    $centroidToKlaster = [
        $finalCentroids[0]['index'] => 1, // aman
        $finalCentroids[1]['index'] => 2, // sedang
        $finalCentroids[2]['index'] => 3, // rawan
    ];

    // Update ke database
    foreach ($data as $item) {
        Curas::where('id', $item->id)->update([
            'klaster_id' => $centroidToKlaster[$item->temp_klaster],
        ]);
    }

    session(['hasil_iterasi' => $iterasi]);

    return response()->json($iterasi);
    }

}
