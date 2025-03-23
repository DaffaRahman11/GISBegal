<x-layoutAdmin>
    <div class="content-page">
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Sale</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/kecamatan/{{ $kecamatan -> id }}" data-toggle="validator" method="post">
                            @method('put')
                            @csrf
                            <div class="row">          
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Kecamatan</label>
                                        <input type="text" class="form-control  @error('detail') is-invalid @enderror" placeholder="Nama Kecamatan" value="{{ old('nama_kecamatan',  $kecamatan -> nama_kecamatan )}}" id="nama_kecamatan" name="nama_kecamatan">
                                        @error('nama_kecamatan')
                                        <div class="invalid-feedback">{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>                            
                            <button type="submit" class="btn btn-primary mr-2">Ubah Data Kecamatan</button>
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
    