<x-layoutAdmin>
    <div class="content-page">
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Tambah Data Kasus Pencurian Kendaraan Bermotor ( CURANMOR )</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/dashboard/curanmor" data-toggle="validator" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Nama Kecamatan *</label>
                                        <select  class="selectpicker form-control" data-style="py-0" id="kecamatan_id" name="kecamatan_id">
                                            <option value="" selected disabled>Pilih Kecamatan</option>
                                            @foreach ( $kecamatans as $kecamatan )
                                            <option value="{{ $kecamatan -> id }}" >{{ $kecamatan -> nama_kecamatan }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>          
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah Kasus Curanmor *</label>
                                        <input type="text" class="form-control" placeholder="Jumlah Kasus Curanmor" id="curanmor" name="jumlah_curanmor">
                                    </div>
                                </div>
                                
                            </div>                            
                            <button type="submit" class="btn btn-primary mr-2">Tambah Data Kasus Curanmor</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
     </div>
    </div>
</x-layoutAdmin>
    