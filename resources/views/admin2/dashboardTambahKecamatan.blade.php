<x-layoutAdmin>
    <div class="content-page">
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Tambah Data Kecamatan Baru</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/dashboard/kecamatan" data-toggle="validator" method="POST">
                            @csrf
                            <div class="row">          
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Kecamatan</label>
                                        <input type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" placeholder="Nama Kecamatan" id="nama_kecamatan" name="nama_kecamatan">
                                        @error('nama_kecamatan')
                                        <div class="invalid-feedback">{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>                            
                            <button type="submit" class="btn btn-primary mr-2">Tambah Data Kecamatan</button>
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
    