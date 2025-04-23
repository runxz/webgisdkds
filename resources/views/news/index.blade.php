@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-8 text-center">📰 News & Announcements</h1>

        @auth
            @if(auth()->user()->role === 'admin')
                <div class="mb-6 text-center">
                    <a href="{{ route('news.create') }}"
                       class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                        + Add News
                    </a>
                </div>
            @endif
        @endauth

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($news as $item)
                <div class="bg-white rounded shadow overflow-hidden hover:shadow-lg transition flex flex-col">
                    <a href="{{ route('news.show', $item) }}">
                        @if ($item->thumbnail)
                            <img src="{{ $item->thumbnail }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                        @endif

                        <div class="p-4">
                            <span class="text-xs uppercase text-gray-500">{{ $item->category }}</span>
                            <h2 class="text-lg font-semibold mt-2">{{ $item->title }}</h2>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-3">
                                {{ Str::limit(strip_tags($item->content), 100) }}
                            </p>
                        </div>
                    </a>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="p-4 flex justify-between items-center border-t mt-auto">
                                <a href="{{ route('news.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>

                                <form action="{{ route('news.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this news item?')">
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
