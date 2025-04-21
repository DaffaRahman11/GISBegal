<x-layoutAdmin>    
    <div class="content-page">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Detail Kasus Curanmor Per Tanggal</h4>
                        <p class="mb-0">Berikut ini merupakan rincian kasus Pencurian Kendaraan Bermotor (CURANMOR)
                            yang dikelompokkan berdasarkan tanggal di inputkannya kasus CURANMOR yang terjadi</p>
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
                <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>Tanggal</th>
                            <th>Nama Kecamatan</th>
                            <th>Tambahan Kasus Curanmor</th>
                            <th>Total Curanmor Per Kecamatan</th>
                            <th>Hapus Update Kasus</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @php
                            $grouped = $detail_curanmor->groupBy(function($item) {
                                return $item->created_at->format('Y-m-d');
                            });
                        @endphp
                        @foreach($grouped as $tanggal => $items)
                        @foreach($items as $index => $detail)
                        <tr>
                            @if ($index == 0)
                                <td rowspan="{{ $items->count() }}">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td>
                            @endif
                            <td class="text-left">{{ $detail->detailCuranmor_Kecamatan->nama_kecamatan }}</td>
                            <td class="text-center">{{ $detail->tambahan_curanmor }}</td>
                            <td class="text-center">{{ $detail->detailCuranmor_Curanmor->jumlah_curanmor }}</td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <form action="/dashboard/detail-curanmor/{{ $detail->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-warning mr-2 border-0"><i class="ri-delete-bin-line mr-0"></i></button>
                                            
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach     
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <!-- Page end  -->
        </div>
    </div>
</x-layoutAdmin>