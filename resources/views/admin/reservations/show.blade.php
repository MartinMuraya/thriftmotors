@extends('layouts.admin')

@section('title', 'Reservation #' . $reservation->id . ' - Admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.reservations.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
        ← Back to Reservations
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Reservation Details --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h2 class="text-xl font-bold mb-4 dark:text-white">Reservation #{{ $reservation->id }}</h2>
            <dl class="grid grid-cols-2 gap-4 text-sm">
                <div><dt class="text-gray-500 dark:text-gray-400">Car</dt><dd class="font-semibold dark:text-white">{{ $reservation->car->title ?? '—' }}</dd></div>
                <div><dt class="text-gray-500 dark:text-gray-400">Customer</dt><dd class="font-semibold dark:text-white">{{ $reservation->customer_name ?? '—' }}</dd></div>
                <div><dt class="text-gray-500 dark:text-gray-400">Phone</dt><dd class="font-mono dark:text-gray-300">{{ $reservation->phone }}</dd></div>
                <div><dt class="text-gray-500 dark:text-gray-400">Amount Paid</dt><dd class="font-semibold text-green-700 dark:text-green-500">KES {{ number_format($reservation->amount_paid) }}</dd></div>
                <div><dt class="text-gray-500 dark:text-gray-400">Status</dt>
                    <dd>
                        @php $colors = ['pending'=>'yellow','paid'=>'green','cancelled'=>'red','expired'=>'gray']; $c = $colors[$reservation->status] ?? 'gray'; @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-bold bg-{{ $c }}-100 text-{{ $c }}-800 dark:bg-{{ $c }}-900/30 dark:text-{{ $c }}-400">{{ ucfirst($reservation->status) }}</span>
                    </dd>
                </div>
                <div><dt class="text-gray-500 dark:text-gray-400">Created</dt><dd class="dark:text-gray-300">{{ $reservation->created_at->format('d M Y H:i') }}</dd></div>
                <div><dt class="text-gray-500 dark:text-gray-400">Expires</dt><dd class="dark:text-gray-300">{{ $reservation->expires_at?->format('d M Y H:i') ?? '—' }}</dd></div>
                <div><dt class="text-gray-500 dark:text-gray-400">Days Remaining</dt><dd class="dark:text-gray-300">{{ $reservation->daysRemaining() }} days</dd></div>
            </dl>
        </div>

        {{-- Payments --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="font-bold mb-4 dark:text-white">Payment History</h3>
            @forelse($reservation->payments as $payment)
                <div class="border dark:border-gray-700 rounded-lg p-4 mb-3 text-sm">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold dark:text-white">KES {{ number_format($payment->amount) }}</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold
                              {{ $payment->status === 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : ($payment->status === 'failed' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400') }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </div>
                    @if($payment->mpesa_receipt)
                        <p class="text-gray-600 dark:text-gray-400">Receipt: <span class="font-mono font-semibold dark:text-gray-200">{{ $payment->mpesa_receipt }}</span></p>
                    @endif
                    <p class="text-gray-400 dark:text-gray-500 mt-1">{{ $payment->created_at->format('d M Y H:i') }}</p>
                </div>
            @empty
                <p class="text-gray-400 dark:text-gray-500 text-sm">No payments recorded.</p>
            @endforelse
        </div>
    </div>

    {{-- Actions --}}
    <div class="space-y-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="font-bold mb-4 dark:text-white">Actions</h3>

            @if($reservation->status === 'paid')
                <form method="POST" action="{{ route('admin.reservations.mark-sold', $reservation) }}" class="mb-3">
                    @csrf
                    <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 font-semibold text-sm"
                            onclick="return confirm('Mark this car as sold?')">
                        <i class="fas fa-check mr-2"></i>Mark as Sold
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.reservations.cancel', $reservation) }}">
                    @csrf
                    <button class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 font-semibold text-sm"
                            onclick="return confirm('Cancel this reservation and free the car?')">
                        <i class="fas fa-times mr-2"></i>Cancel Reservation
                    </button>
                </form>
            @else
                <p class="text-gray-400 dark:text-gray-500 text-sm text-center">No actions available for this status.</p>
            @endif
        </div>

        {{-- Car Quick Info --}}
        @if($reservation->car)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="font-bold mb-3 dark:text-white">Car</h3>
            <p class="font-semibold text-sm dark:text-white">{{ $reservation->car->title }}</p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">KES {{ number_format($reservation->car->price) }}</p>
            <p class="mt-2">
                <span class="px-2 py-1 rounded-full text-xs font-bold
                    {{ $reservation->car->status === 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : ($reservation->car->status === 'reserved' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                    {{ ucfirst($reservation->car->status) }}
                </span>
            </p>
            <a href="{{ route('admin.cars.show', $reservation->car) }}"
               class="text-blue-600 dark:text-blue-400 hover:underline text-sm block mt-3">View Car →</a>
        </div>
        @endif
    </div>
</div>
@endsection
