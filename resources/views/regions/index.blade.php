@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">🗺️ Regions</h1>

        @auth
            @if(auth()->user()->role === 'admin')
                <div class="mb-4 text-center">
                    <a href="{{ route('regions.create') }}" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                        + New Region
                    </a>
                            <!-- Region List -->
            <div>
                <ul class="space-y-4">
                    @foreach($regions as $region)
                        <li class="bg-white p-4 rounded shadow">
                            <div class="flex justify-between items-center">
                                <div>
                                    <a href="{{ route('regions.show', $region) }}" class="text-lg font-semibold text-blue-600 hover:underline">
                                        {{ $region->name }}
                                    </a>
                                    <p class="text-sm text-gray-500">Type: {{ $region->type }}</p>
                                </div>

                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <div class="flex gap-4 items-center">
                                            <a href="{{ route('regions.edit', $region) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('regions.destroy', $region) }}" method="POST" onsubmit="return confirm('Delete this region?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
                </div>
            @endif
        @endauth

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
  

            <!-- Leaflet Map Container -->
            <div>
                <div id="map" class="w-full rounded shadow" style="height: 500px"></div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Check if Leaflet is loaded
            if (typeof L === 'undefined') {
                console.error('Leaflet library failed to load');
                return;
            }

            // Initialize map with fallback coordinates
            const map = L.map('map').setView([-0.5, 100.5], 6);

            // Add tile layer with error handling
            const osmTileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).on('tileerror', function (error) {
                console.error('Map tile loading error:', error);
            }).addTo(map);

            // Create feature group to store all regions
            const regionsGroup = L.featureGroup().addTo(map);

            // Add regions to map
            @foreach($regions as $region)
                @if($region->geometry)
                    try {
                        // Parse GeoJSON data
                        const geoData = JSON.parse({!! json_encode($region->geometry) !!});
                        
                        // Create GeoJSON layer
                        const regionLayer = L.geoJSON(geoData, {
                            style: {
                                color: '#3B82F6',
                                weight: 2,
                                fillOpacity: 0.2
                            }
                        }).bindPopup(`
                            <strong>${@json($region->name)}</strong><br>
                            Type: ${@json($region->type)}
                        `);

                        // Add to feature group
                        regionsGroup.addLayer(regionLayer);

                    } catch (error) {
                        console.error('Error processing region {{ $region->id }}:', error);
                    }
                @endif
            @endforeach

       

            // Adjust view to show all regions
            if (regionsGroup.getLayers().length > 0) {
                map.fitBounds(regionsGroup.getBounds().pad(0.2));
            } else {
                console.warn('No geographic regions found to display');
                map.setView([-0.5, 100.5], 6);
            }
        });
    </script>
@endpush