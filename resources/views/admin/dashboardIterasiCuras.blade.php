<x-layoutAdmin>    
    <div class="content-page">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Iterasi K-Means Untuk Kasus Curas</h4>
                        <p class="mb-0">Sales enables you to effectively control sales KPIs and monitor them in one central<br>
                         place while helping teams to reach sales goals. </p>
                    </div>
                    <a href="/curas/create" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Kasus Curas</a>
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
                @foreach ($iterasi as $i => $baris)
                <h4>Iterasi {{ $i + 1 }}</h4>
                <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox1">
                                    <label for="checkbox1" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No</th>
                            <th>Nama Kecamatan</th>
                            <th>Jarak Ke Centroid 1</th>
                            <th>Jarak Ke Centroid 2</th>
                            <th>Jarak Ke Centroid 3</th>
                        </tr>
                    </thead>
                    @foreach ($baris as $row)
                    <tbody class="ligth-body">
                        <tr>
                            <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2">
                                    <label for="checkbox2" class="mb-0"></label>
                                </div>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row['kecamatan_id'] }}</td>
                            <td>{{ $row['jarakC1'] }}</td>
                            <td>{{ $row['jarakC2'] }}</td>
                            <td>{{ $row['jarakC3'] }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Page end  -->
        </div>
    </div>
</x-layoutAdmin>