@extends('layouts.admin')

@section('title', 'Reservations - Admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold dark:text-white">Reservations</h1>

    {{-- Status Filter --}}
    <div class="flex gap-2">
        @foreach(['', 'pending', 'paid', 'cancelled', 'expired'] as $s)
            <a href="{{ request()->fullUrlWithQuery(['status' => $s]) }}"
               class="px-3 py-1 rounded-full text-sm font-medium border transition-colors duration-300
                      {{ request('status', '') === $s ? 'bg-gray-800 dark:bg-gray-100 text-white dark:text-gray-800 border-gray-800 dark:border-gray-100' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                {{ $s === '' ? 'All' : ucfirst($s) }}
            </a>
        @endforeach
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden border border-transparent dark:border-gray-700 transition-colors duration-300">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700/50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Car</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Expires</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($reservations as $reservation)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.cars.show', $reservation->car) }}"
                           class="text-blue-600 dark:text-blue-400 hover:underline font-medium text-sm">
                            {{ $reservation->car->title ?? '—' }}
                        </a>
                    </td>
                    <td class="px-6 py-4 text-sm dark:text-gray-300">{{ $reservation->customer_name ?? '—' }}</td>
                    <td class="px-6 py-4 text-sm font-mono dark:text-gray-300">{{ $reservation->phone }}</td>
                    <td class="px-6 py-4 text-sm font-semibold dark:text-white">KES {{ number_format($reservation->amount_paid) }}</td>
                    <td class="px-6 py-4">
                        @php
                            $colors = [
                                'pending'   => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                'paid'      => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                'expired'   => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $colors[$reservation->status] ?? '' }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ $reservation->expires_at?->format('d M Y') ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.reservations.show', $reservation) }}"
                           class="text-blue-600 dark:text-blue-400 hover:underline text-sm mr-3">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-400 dark:text-gray-500">No reservations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t dark:border-gray-700">{{ $reservations->links() }}</div>
</div>
@endsection
