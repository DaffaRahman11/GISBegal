<x-layoutAdmin>
    <div class="content-page">
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Tambah Data Kasus Pencurian Dengan Kekerasan ( CURAS )</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="page-list-returns.html" data-toggle="validator">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div class="form-group">
                                        <label>Nama Kecamatan *</label>
                                        <select name="type" class="selectpicker form-control" data-style="py-0">
                                            <option value="" selected disabled>Pilih Kecamatan</option>
                                            <option>Leces</option>
                                            <option>Dringu</option>
                                            <option>Pajarakan</option>
                                        </select>
                                    </div>
                                </div>          
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah Kasus Curas *</label>
                                        <input type="text" class="form-control" placeholder="Jumlah Kasus Curas">
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Klaster *</label>
                                        <select name="type" class="selectpicker form-control" data-style="py-0">
                                            <option value="" selected disabled>Pilih Kecamatan</option>
                                            <option>Aman</option>
                                            <option>Sedang</option>
                                            <option>Rawan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                            
                            <button type="submit" class="btn btn-primary mr-2">Tambah Data Kasus Curas</button>
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
    