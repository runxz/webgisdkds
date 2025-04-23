@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-8 text-center">📸 Gallery</h1>

        @auth
            @if(auth()->user()->role === 'admin')
                <div class="mb-6 text-center">
                    <a href="{{ route('galleries.create') }}"
                       class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                        + Add Media
                    </a>
                </div>
            @endif
        @endauth

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($galleries as $item)
                <div class="bg-white rounded shadow overflow-hidden flex flex-col">
                    <div class="aspect-video">
                        @if ($item->media_type === 'photo')
                            <img src="{{ $item->media_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        @elseif ($item->media_type === 'video')
                            <iframe src="{{ $item->media_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                        @endif
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $item->title }}</h2>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->description, 80) }}</p>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="p-4 flex justify-between items-center border-t mt-auto">
                                <a href="{{ route('galleries.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('galleries.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this media?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>
    </div>
@endsection
