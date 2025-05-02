<x-layoutAdmin>
    <div class="content-page">
     <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-transparent card-block card-stretch card-height border-none">
                    <div class="card-body p-0 mt-lg-2 mt-0">
                        <h3 class="mb-3">Hai {{ Auth::user()->nama }}</h3>
                        <p class="mb-0 mr-4">Selamat Datang di Dashboard Admin Sistem Informasi Geografis (SIG) PROTECT</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <img src="../assets/images/product/1.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">
                                            <strong> Kecamatan Rawan Curas </strong>
                                        </p>
                                        <h4>{{ $jumlahRawanCuras }}</h4>
                                    </div>
                                </div>                                
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-info iq-progress progress-1" data-percent="{{ $prosentaseCuras }}">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <img src="../assets/images/product/2.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2"> 
                                            <strong> Kecamatan Rawan Ranmor </strong>
                                        </p>
                                        <h4>{{ $jumlahRawanCuranmor }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-danger iq-progress progress-1" data-percent="{{ $prosentaseCuranmor }}">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="../assets/images/product/3.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">
                                            <strong>Kecamatan Kab Probolinggo</strong>
                                        </p>
                                        <h4>{{ $totalKecamatan }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="100">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Pemetaan Curas dan Curanmor Kab Probolinggo</h4>
                        </div>                        
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span id="dropdownMenuButton001" class="dropdown-toggle dropdown-bg btn" data-toggle="dropdown">
                                    <span id="currentMapLabel">Curas</span> <i class="ri-arrow-down-s-line ml-1"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton001">
                                    <a class="dropdown-item" href="#" id="btn-curas">Curas</a>
                                    <a class="dropdown-item" href="#" id="btn-curanmor">Curanmor</a>
                                </div>

                                
                            </div>
                        </div>
                    </div>                    
                    <div class="card-body">
                        <div id="map" style="width: 100%; height: 500px;" ></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Revenue Vs Cost</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton002"
                                    data-toggle="dropdown">
                                    This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton002">
                                    <a class="dropdown-item" href="#">Curas</a>
                                    <a class="dropdown-item" href="#">Curanmor</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="layout1-chart-2" style="min-height: 360px;"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Page end  -->
        
    </div>
    {{-- Script MAP --}}
    <script>
        let map;
        let geoLayer;
        let mapTitle = document.querySelector('.card-title');
        let apiUrl = "{{ url('/api/map/curas') }}"; // default awal curas
        let curasData = {};
    
        function fetchAndLoadMap(url, titleText) {
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    curasData = {};
                    data.forEach(item => {
                        curasData[item.kecamatan] = item;
                    });
                    mapTitle.textContent = titleText;
    
                    if (geoLayer) {
                        geoLayer.remove(); // hapus layer lama
                    }
    
                    geoLayer = new L.GeoJSON.AJAX(["{{ asset('/assets/map/gisProbolinggo.geojson') }}"], {
                        style: styleFeature,
                        onEachFeature: popUp
                    });
                    geoLayer.addTo(map);
                });
        }
    
        function getColor(warna) {
            return warna || '#cccccc';
        }
    
        function styleFeature(feature) {
            let namaKecamatan = feature.properties.WADMKC;
            let data = curasData[namaKecamatan];
    
            return {
                fillColor: data ? getColor(data.warna) : '#cccccc',
                weight: 1,
                opacity: 1,
                color: 'white',
                fillOpacity: 0.7
            };
        }
    
        function popUp(feature, layer) {
            let namaKecamatan = feature.properties.WADMKC;
            let data = curasData[namaKecamatan];
    
            let content = `<strong>Kecamatan ${namaKecamatan}</strong><br/><br/>`;
            if (data) {
                if ('jumlah_curas' in data) {
                    content += `Jumlah Curas: ${data.jumlah_curas}<br/>Kategori: ${data.klaster}`;
                } else if ('jumlah_curanmor' in data) {
                    content += `Jumlah Curanmor: ${data.jumlah_curanmor}<br/>Kategori: ${data.klaster}`;
                }
            } else {
                content += `Data tidak tersedia`;
            }
    
            layer.bindPopup(content);
        }
    
        function loadInitialMap() {
            map = L.map('map').setView([-7.843271790154591, 113.2990930356143], 10);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            fetchAndLoadMap(apiUrl, 'Pemetaan Curas Kab Probolinggo');
        }
    
        // Event dropdown
        document.addEventListener('DOMContentLoaded', () => {
            loadInitialMap();
    
            document.getElementById('btn-curas').addEventListener('click', (e) => {
                e.preventDefault();
                fetchAndLoadMap("{{ url('/api/map/curas') }}", "Pemetaan Curas Kab Probolinggo");
            });
    
            document.getElementById('btn-curanmor').addEventListener('click', (e) => {
                e.preventDefault();
                fetchAndLoadMap("{{ url('/api/map/curanmor') }}", "Pemetaan Curanmor Kab Probolinggo");
            });
        });
    </script>

<script>
    document.querySelectorAll('.dropdown-item').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('currentMapLabel').textContent = this.textContent;
        });
    });
</script>

    
</x-layoutAdmin>