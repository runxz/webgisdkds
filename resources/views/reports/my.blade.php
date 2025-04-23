@extends('layouts.app')

@section('content')
    <h1>My Submitted Reports</h1>
    <ul>
        @foreach ($myReports as $report)
            <li>
                <strong>{{ $report->title }}</strong> - {{ $report->status }}
                <a href="{{ route('reports.show', $report) }}">View</a>
            </li>
        @endforeach
    </ul>
@endsection
