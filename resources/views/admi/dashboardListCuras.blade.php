<x-layoutAdmin>    
    <div class="content-page">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Daftar Kasus Pencurian Dengan Kekerasan (CURAS)</h4>
                        <p class="mb-0">Berikut ini merupakan data kasus Pencurian Dengan Kekerasan (CURAS) pada <br>
                            masing masing kecamatan di Kabupaten Probolinggo</p>
                    </div>
                    <a href="/dashboard/curas/create" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Kasus Curas</a>
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
                            <th>Jumlah Kasus Curas</th>
                            <th>Klaster</th>
                        </tr>
                    </thead>
                    @foreach ( $curases as $curas )
                    <tbody class="ligth-body">
                        <tr>
                            <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2">
                                    <label for="checkbox2" class="mb-0"></label>
                                </div>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $curas->punyaKecamatanCuras->nama_kecamatan}}</td>
                            <td>{{ $curas->jumlah_curas }}</td>
                            <td style="background-color: {{ $curas->punyaKlasterCuras->warna }}">{{ $curas->punyaKlasterCuras->nama_klaster }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
        <!-- Page end  -->
        </div>
    </div>
</x-layoutAdmin>