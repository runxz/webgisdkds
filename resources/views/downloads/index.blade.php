@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-8 text-center">📂 Downloads</h1>

        @auth
            @if(auth()->user()->role === 'admin')
                <div class="mb-6 text-center">
                    <a href="{{ route('downloads.create') }}"
                       class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                        + Upload File
                    </a>
                </div>
            @endif
        @endauth

        <div class="bg-white shadow rounded divide-y divide-gray-200">
            @forelse ($downloads as $file)
                <div class="p-4 flex justify-between items-center">
                    <div>
                        <h2 class="font-semibold text-lg">{{ $file->title }}</h2>
                        @if ($file->category)
                            <p class="text-sm text-gray-500">Category: {{ $file->category }}</p>
                        @endif
                    </div>

                    <div class="flex space-x-4 items-center">
                        <a href="{{ asset('storage/' . $file->file_path) }}"
                           target="_blank"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Download
                        </a>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('downloads.edit', $file) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('downloads.destroy', $file) }}" method="POST" onsubmit="return confirm('Delete this file?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-gray-500">No files available yet.</div>
            @endforelse
        </div>
    </div>
@endsection
