<x-layoutAdmin>
    <div class="content-page">
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Ubah Data Kasus CURANMOR Pada Kecamatan 
                                {{ $curanmor->punyaKecamatanCuranmor->nama_kecamatan}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/dashboard/curanmor/{{ $curanmor->id }}" data-toggle="validator" method="post">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div class="form-group">
                                        <label>Nama Kecamatan *</label>
                                        <input type="text" class="form-control" placeholder="Nama Kecamatan" 
                                            id="nama_kecamatan" name="nama_kecamatan" 
                                            value="{{ $curanmor->punyaKecamatanCuranmor->nama_kecamatan }}" 
                                            readonly>

                                        <!-- Input hidden untuk mengirim ID kecamatan -->
                                        <input type="hidden" name="kecamatan_id" value="{{ $curanmor->kecamatan_id }}">
                                    </div>
                                </div>          
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah Kasus Curanmor *</label>
                                        <input type="text" class="form-control" placeholder="Jumlah Kasus Curanmor" id="jumlah_curanmor" name="jumlah_curanmor" value="{{ old('jumlah_curanmor',  $curanmor ->jumlah_curanmor )}}">
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Klaster *</label>
                                        <select  class="selectpicker form-control" data-style="py-0" name="klaster_id" id="klaster_id">
                                            <option value="" selected disabled>Pilih Klaster</option>
                                            @foreach ( $klasters as $klaster )
                                            <option value="{{ $klaster->id }}" style="background-color: {{ $klaster->warna }}" {{ old('klaster_id', $curanmor->klaster_id) == $klaster->id ? 'selected' : '' }}>{{ $klaster->nama_klaster }}</option> 
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>                            
                            <button type="submit" class="btn btn-primary mr-2">Ubah Data Kasus CURANMOR</button>
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
    