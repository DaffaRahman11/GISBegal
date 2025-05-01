<x-layoutAdmin>    
    <div class="content-page">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Detail Perhitungan Curanmor</h4>
                        <p class="mb-0">Berikut merupakan detail perhitungan jarak antar setiap data terhadap setiap centroid pada masing masing iterasi. </p>
                    </div>
                    
                </div>
                @if (session()->has('succes'))
                    <div class="alert alert-success" role="alert">
                        {{ session('succes') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="col-lg-12">
                <h5>Nilai Centroid Awal</h5>
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            @foreach ($data['centroid_awal'] as $centroid)
                                <th class="text-center">{{ array_key_first($centroid) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        <tr>
                            @foreach ($data['centroid_awal'] as $centroid)
                                <td class="text-center">{{ array_values($centroid)[0] }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <br><br><br>
                @foreach ($data['iterasi'] as $index => $iterasi)
                <h5>Iterasi ke-{{ $index + 1 }}</h5>
                <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>Nama Kecamatan</th>
                            @foreach (array_keys($iterasi[0]) as $key)
                                @if ($key !== 'kecamatan_id')
                                    <th class="text-center">{{ $key }}</th>
                                @endif
                            @endforeach
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach ($iterasi as $row)
                            @php
                                $minKey = null;
                                $minVal = INF;
                                foreach ($row as $key => $val) {
                                    if (strpos($key, 'C') === 0 && $val < $minVal) {
                                        $minVal = $val;
                                        $minKey = $key;
                                    }
                                }
                            @endphp
                            <tr>
                                <td class="text-left">{{ $kecamatan[$row['kecamatan_id']] ?? 'Tidak Diketahui' }}</td>
                                @foreach ($row as $key => $val)
                                    @if ($key !== 'kecamatan_id')
                                        <td class="text-center">{{ $val }}</td>
                                    @endif
                                @endforeach
                                <td><strong>{{ strtoupper($minKey) }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Page end  -->
        </div>
    </div>
</x-layoutAdmin>