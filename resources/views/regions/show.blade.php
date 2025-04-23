@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css"/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
@endpush
<div id="map" style="height: 400px;"></div>

@push('scripts')
<script>
    const map = L.map('map').setView([-0.5, 100.5], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OSM contributors'
    }).addTo(map);

    const geometry = {!! json_encode($region->geometry) !!};
    const geoLayer = L.geoJSON(geometry).addTo(map);
    map.fitBounds(geoLayer.getBounds());
</script>
@endpush
