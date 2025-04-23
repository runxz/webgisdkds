@extends('layouts.app')

@section('content')
    <h1>Edit Report</h1>

    <form action="{{ route('reports.update', $report) }}" method="POST">
        @csrf @method('PUT')

        <input type="text" name="title" value="{{ $report->title }}" required><br>
        <textarea name="content" required>{{ $report->content }}</textarea><br>

        <select name="region_id">
            @foreach($regions as $region)
                <option value="{{ $region->id }}" @if($report->region_id == $region->id) selected @endif>
                    {{ $region->name }}
                </option>
            @endforeach
        </select><br>

        <select name="status">
            @foreach(['pending','verified','rejected'] as $s)
                <option value="{{ $s }}" @if($report->status == $s) selected @endif>{{ ucfirst($s) }}</option>
            @endforeach
        </select><br>

        <button type="submit">Update</button>
    </form>
@endsection
