@extends('layouts.admin')

@section('title', 'Reservations - Admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Reservations</h1>

    {{-- Status Filter --}}
    <div class="flex gap-2">
        @foreach(['', 'pending', 'paid', 'cancelled', 'expired'] as $s)
            <a href="{{ request()->fullUrlWithQuery(['status' => $s]) }}"
               class="px-3 py-1 rounded-full text-sm font-medium border
                      {{ request('status', '') === $s ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100' }}">
                {{ $s === '' ? 'All' : ucfirst($s) }}
            </a>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Car</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expires</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($reservations as $reservation)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.cars.show', $reservation->car) }}"
                           class="text-blue-600 hover:underline font-medium text-sm">
                            {{ $reservation->car->title ?? '—' }}
                        </a>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $reservation->customer_name ?? '—' }}</td>
                    <td class="px-6 py-4 text-sm font-mono">{{ $reservation->phone }}</td>
                    <td class="px-6 py-4 text-sm font-semibold">KES {{ number_format($reservation->amount_paid) }}</td>
                    <td class="px-6 py-4">
                        @php
                            $colors = [
                                'pending'   => 'bg-yellow-100 text-yellow-800',
                                'paid'      => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800',
                                'expired'   => 'bg-gray-100 text-gray-700',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $colors[$reservation->status] ?? '' }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $reservation->expires_at?->format('d M Y') ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.reservations.show', $reservation) }}"
                           class="text-blue-600 hover:underline text-sm mr-3">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-400">No reservations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t">{{ $reservations->links() }}</div>
</div>
@endsection
