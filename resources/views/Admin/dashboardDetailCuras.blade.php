<x-layoutAdmin>    
    <div class="content-page">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Detail Kasus Curas Per Tanggal</h4>
                        <p class="mb-0">Berikut ini merupakan rincian kasus Pencurian Dengan Kekerasan (CURAS)  <br>
                            yang dikelompokkan berdasarkan tanggal</p>
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
                            <th>Tanggal</th>
                            <th>Tambahan Kasus Curas</th>
                            <th>Nama Kecamatan</th>
                            <th>Hapus Kasus</th>
                        </tr>
                    </thead>
                    {{-- @foreach ( $curases as $curas ) --}}
                    <tbody class="ligth-body">
                        <tr>
                            <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2">
                                    <label for="checkbox2" class="mb-0"></label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <form action="/dashboard/curanmor/" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-warning mr-2 border-0"><i class="ri-delete-bin-line mr-0"></i></button>
                                            
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    {{-- @endforeach --}}
                </table>
                </div>
            </div>
        </div>
        <!-- Page end  -->
        </div>
    </div>
</x-layoutAdmin>