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
                        <form action="page-list-returns.html" data-toggle="validator">
                            <div class="row">          
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Klaster</label>
                                        <input type="text" class="form-control" placeholder="Nama Klaster">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="warna">Pilih Warna</label>
                                        <input placeholder="Pilih Warna" type="color" id="warna" name="warna" class="form-control" value="#ff0000">
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
    