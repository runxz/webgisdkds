@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-blue-600 text-white text-center py-20">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Welcome to WebGIS Nagari</h1>
            <p class="text-lg">Explore regional data, submit reports, and access services in your Nagari.</p>

        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-white text-gray-700 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold mb-4">About WebGIS Nagari</h2>
            <p class="text-lg leading-relaxed">
                WebGIS Nagari is a Geographic Information System portal for managing, viewing, and reporting regional developments.
                It brings digital accessibility to your Nagari’s spatial data and public services.
            </p>
        </div>
    </section>

    <!-- Features Cards -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-6 text-center">
                <a href="{{ route('galleries.index') }}" class="bg-white p-6 rounded shadow hover:bg-blue-50">
                    <h3 class="text-xl font-semibold mb-2">📸 View Gallery</h3>
                    <p>Explore events, tourism spots, and local visuals.</p>
                </a>

                <a href="{{ route('news.index') }}" class="bg-white p-6 rounded shadow hover:bg-blue-50">
                    <h3 class="text-xl font-semibold mb-2">📰 News & Announcements</h3>
                    <p>Stay updated with the latest Nagari news and events.</p>
                </a>

                <a href="{{ route('downloads.index') }}" class="bg-white p-6 rounded shadow hover:bg-blue-50">
                    <h3 class="text-xl font-semibold mb-2">📂 Download Files</h3>
                    <p>Access forms, regulations, and documents.</p>
                </a>
            </div>
        </div>
    </section>
@endsection
