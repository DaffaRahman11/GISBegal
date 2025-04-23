<x-layoutAdmin>
    <div class="content-page">
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Tambah Klaster Baru</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/dashboard/klaster" data-toggle="validator" method="POST">
                            @csrf
                            <div class="row">          
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Klaster</label>
                                        <input type="text" class="form-control @error('nama_klaster') is-invalid @enderror" placeholder="Nama Klaster" id="nama_klaster" name="nama_klaster">
                                        @error('nama_klaster')
                                        <div class="invalid-feedback">{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pilih Warna</label>
                                        <input type="color" class="form-control @error('warna') is-invalid @enderror" placeholder="warna" id="warna" name="warna">
                                        @error('warna')
                                        <div class="invalid-feedback">{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>                            
                            <button type="submit" class="btn btn-primary mr-2">Tambah Klaster</button>
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
    