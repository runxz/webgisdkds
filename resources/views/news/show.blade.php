@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-8 text-center">🗺️ Regions</h1>

        @auth
            @if(auth()->user()->role === 'admin')
                <div class="mb-6 text-center">
                    <a href="{{ route('regions.create') }}"
                       class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                        + New Region
                    </a>
                </div>
            @endif
        @endauth

        <ul class="space-y-4">
            @foreach($regions as $region)
                <li class="bg-white shadow-sm rounded px-4 py-3 flex justify-between items-center">
                    <div>
                        <a href="{{ route('regions.show', $region) }}" class="text-lg font-semibold text-blue-600 hover:underline">
                            {{ $region->name }}
                        </a>
                        <span class="ml-2 text-sm text-gray-500">({{ $region->type }})</span>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="flex space-x-4 items-center">
                                <a href="{{ route('regions.edit', $region) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('regions.destroy', $region) }}" method="POST" onsubmit="return confirm('Delete this region?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </li>
            @endforeach
        </ul>
    </div>
@endsection
