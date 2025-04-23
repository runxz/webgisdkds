@extends('layouts.app')

@section('content')
    <h1>Submit Report</h1>

    <form action="{{ route('reports.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Content" required></textarea><br>

        <select name="region_id" required>
            @foreach($regions as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
            @endforeach
        </select><br>

        <button type="submit">Submit</button>
    </form>
@endsection
