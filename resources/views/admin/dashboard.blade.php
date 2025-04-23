@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="p-4 bg-white dark:bg-gray-800 rounded shadow">
            <h2 class="text-lg font-semibold">Total Users</h2>
            <p class="text-2xl">{{ $stats['users'] }}</p>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800 rounded shadow">
            <h2 class="text-lg font-semibold">Total Regions</h2>
            <p class="text-2xl">{{ $stats['regions'] }}</p>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800 rounded shadow">
            <h2 class="text-lg font-semibold">Total Reports</h2>
            <p class="text-2xl">{{ $stats['reports']['total'] }}</p>
        </div>

        <div class="p-4 bg-yellow-100 dark:bg-yellow-900 rounded shadow">
            <h2 class="font-semibold">Pending</h2>
            <p class="text-xl">{{ $stats['reports']['pending'] }}</p>
        </div>

        <div class="p-4 bg-green-100 dark:bg-green-900 rounded shadow">
            <h2 class="font-semibold">Verified</h2>
            <p class="text-xl">{{ $stats['reports']['verified'] }}</p>
        </div>

        <div class="p-4 bg-red-100 dark:bg-red-900 rounded shadow">
            <h2 class="font-semibold">Rejected</h2>
            <p class="text-xl">{{ $stats['reports']['rejected'] }}</p>
        </div>
    </div>
@endsection
