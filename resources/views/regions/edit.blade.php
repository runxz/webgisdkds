@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css"/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
@endpush
@if($region->geometry)
    const existing = {!! json_encode($region->geometry) !!};
    const existingLayer = L.geoJSON(existing).addTo(drawnItems);
    map.fitBounds(existingLayer.getBounds());
    document.getElementById('geometry').value = JSON.stringify(existing);
@endif

@extends('layouts.app')

@section('content')
    <h1>Edit Region</h1>

    <form action="{{ route('regions.update', $region) }}" method="POST">
        @csrf @method('PUT')

        <input type="text" name="name" value="{{ $region->name }}" required><br>
        <input type="text" name="type" value="{{ $region->type }}" required><br>
        <textarea name="description">{{ $region->description }}</textarea><br>
        <textarea name="geometry">{{ json_encode($region->geometry) }}</textarea><br>

        <button type="submit">Update</button>
    </form>
@endsection
