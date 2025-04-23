@extends('layouts.app')

@section('content')
    <h1>Reports</h1>
    <a href="{{ route('reports.create') }}">+ New Report</a>
    <ul>
        @foreach($reports as $report)
            <li>
                <a href="{{ route('reports.show', $report) }}">{{ $report->title }}</a>
                by {{ $report->user->name }} ({{ $report->status }})
                <a href="{{ route('reports.edit', $report) }}">Edit</a>
                <form action="{{ route('reports.destroy', $report) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
