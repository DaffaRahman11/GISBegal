<x-layoutAdmin>
    <div class="content-page">
     
        <div id="map" style="width: 100%; height: 500px;" ></div>
<script>
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
    </script>
    </div>
</x-layoutAdmin>