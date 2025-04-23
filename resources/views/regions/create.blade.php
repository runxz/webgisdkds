@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css"/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
@endpush
@extends('layouts.app')

@section('content')
<h1>Create Region</h1>

<form method="POST" action="{{ route('regions.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Region Name" required><br>
    <input type="text" name="type" placeholder="Type (e.g. Nagari)" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>

    <div id="map" style="height: 400px;"></div>
    <textarea name="geometry" id="geometry" class="w-full mt-4" rows="4" readonly></textarea>

    <button type="submit">Save</button>
</form>
@endsection

@push('scripts')
<script>
    const map = L.map('map').setView([-0.5, 100.5], 13); // set your region center

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OSM contributors'
    }).addTo(map);

    const drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    const drawControl = new L.Control.Draw({
        edit: { featureGroup: drawnItems },
        draw: {
            polyline: false,
            circle: false,
            rectangle: false,
            marker: true,
            circlemarker: false,
            polygon: true
        }
    });
    map.addControl(drawControl);

    map.on('draw:created', function (e) {
        drawnItems.clearLayers(); // allow only one shape
        drawnItems.addLayer(e.layer);
        document.getElementById('geometry').value = JSON.stringify(e.layer.toGeoJSON().geometry);
    });
</script>
@endpush
