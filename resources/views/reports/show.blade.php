@extends('layouts.app')

@section('content')
    <h1>{{ $report->title }}</h1>
    <p>{{ $report->content }}</p>
    <p>Region: {{ $report->region->name }}</p>
    <p>Status: {{ $report->status }}</p>
    <p>Submitted by: {{ $report->user->name }}</p>
@endsection
