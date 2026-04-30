@extends('layouts.app')

@section('title', 'My Dashboard - ThriftMotors')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold dark:text-white">Welcome, {{ auth()->user()->name }}</h1>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border-l-4 border-red-600 p-6 transition-colors duration-300">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Total Bookings</h3>
            <p class="text-3xl font-bold dark:text-white">{{ $stats['total_bookings'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border-l-4 border-yellow-500 p-6 transition-colors duration-300">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Active Bookings</h3>
            <p class="text-3xl font-bold dark:text-white">{{ $stats['active_bookings'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border-l-4 border-green-500 p-6 transition-colors duration-300">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Done Deals</h3>
            <p class="text-3xl font-bold dark:text-white">{{ $stats['done_deals'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border-l-4 border-blue-500 p-6 transition-colors duration-300">
            <h3 class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Total Spent</h3>
            <p class="text-3xl font-bold dark:text-white">KES {{ number_format($stats['total_spent']) }}</p>
        </div>
    </div>

    <!-- Booking History -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden border border-transparent dark:border-gray-700 transition-colors duration-300">
        <div class="px-6 py-4 border-b dark:border-gray-700">
            <h2 class="text-xl font-bold dark:text-white">My Track Record & Bookings</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Car</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount Paid</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($reservations as $res)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4">
                                <a href="{{ route('cars.show', $res->car->slug) }}" class="text-red-600 dark:text-red-400 hover:underline font-semibold">
                                    {{ $res->car->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $res->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium dark:text-white">KES {{ number_format($res->amount_paid) }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $color = match($res->status) {
                                        'paid' => 'green',
                                        'pending' => 'yellow',
                                        'sold' => 'blue',
                                        'cancelled' => 'red',
                                        'expired' => 'gray',
                                        default => 'gray'
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-{{ $color }}-100 text-{{ $color }}-800 dark:bg-{{ $color }}-900/30 dark:text-{{ $color }}-400 border border-transparent dark:border-{{ $color }}-800/50">
                                    {{ ucfirst($res->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                You haven't made any bookings yet.
                                <br><br>
                                <a href="{{ route('cars.index') }}" class="text-red-600 dark:text-red-400 font-semibold hover:underline">Browse Cars</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
