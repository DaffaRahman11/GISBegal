<x-layoutAdmin>
<div class="content-page">
     
        <div id="map" style="width: 100%; height: 500px;" ></div>
    {{-- <script>
            var map = L.map('map').setView([-7.843271790154591, 113.2990930356143], 10);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,

            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        function popUp(f,l){
        var out = [];
        if (f.properties){
            for(key in f.properties){
                out.push(key+": "+f.properties[key]);
            }
            l.bindPopup(out.join("<br />"));
        }
        }
            var jsonTest = new L.GeoJSON.AJAX(["{{ asset('/assets/map/gisProbolinggo.geojson') }}"],{onEachFeature:popUp}).addTo(map);
    </script> --}}

    <script>
        let curasData = {};
    
        fetch("{{ url('/api/map') }}")
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    curasData[item.kecamatan] = item;
                });
    
                loadMap(); // setelah data siap, jalankan ini
            });
    
        function getColor(klasterWarna) {
            return klasterWarna || '#cccccc'; // fallback
        }
    
        function styleFeature(feature) {
            let namaKecamatan = feature.properties.WADMKC;
            let curas = curasData[namaKecamatan];
    
            return {
                fillColor: curas ? getColor(curas.klaster) : '#cccccc',
                weight: 1,
                opacity: 1,
                color: 'white',
                fillOpacity: 0.7
            };
        }
    
        function popUp(feature, layer) {
            let namaKecamatan = feature.properties.WADMKC;
            let curas = curasData[namaKecamatan];
    
            let content = `<strong>${namaKecamatan}</strong><br/>`;
            if (curas) {
                content += `Jumlah Curas: ${curas.jumlah_curas}<br/>Klaster: ${curas.klaster}`;
            } else {
                content += `Data tidak tersedia`;
            }
    
            layer.bindPopup(content);
        }
    
        function loadMap() {
            var map = L.map('map').setView([-7.843271790154591, 113.2990930356143], 10);
    
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
    
            new L.GeoJSON.AJAX(["{{ asset('/assets/map/gisProbolinggo.geojson') }}"], {
                style: styleFeature,
                onEachFeature: popUp
            }).addTo(map);
        }
    </script>
    

</div>
</x-layoutAdmin>