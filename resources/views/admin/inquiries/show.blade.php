@extends('layouts.admin')

@section('page-title', 'View Inquiry')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold dark:text-white">Inquiry from {{ $inquiry->customer_name }}</h2>
        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                <i class="fas fa-trash mr-2"></i> Delete
            </button>
        </form>
    </div>

    <!-- Inquiry Details -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="md:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 mb-6 transition-colors duration-300">
                <h3 class="text-lg font-bold mb-4 dark:text-white">About the Car</h3>
                <div class="flex gap-4">
                    @if($inquiry->car->images->count() > 0)
                        <img src="{{ $inquiry->car->images->first()->image_url }}" alt="" class="w-32 h-32 object-cover rounded">
                    @endif
                    <div>
                        <h4 class="text-lg font-semibold dark:text-white">{{ $inquiry->car->title }}</h4>
                        <p class="text-gray-600 dark:text-gray-400">Year: {{ $inquiry->car->year }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Price: KES {{ number_format($inquiry->car->price, 0) }}</p>
                        <a href="{{ route('admin.cars.show', $inquiry->car) }}" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 mt-2 inline-block">
                            View Car Details <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
                <h3 class="text-lg font-bold mb-4 dark:text-white">Customer Message</h3>
                @if($inquiry->message)
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $inquiry->message }}</p>
                @else
                    <p class="text-gray-500 dark:text-gray-400 italic">No message provided</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Customer Info -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 mb-6 transition-colors duration-300">
                <h3 class="text-lg font-bold mb-4 dark:text-white">Customer Information</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Name</p>
                        <p class="font-semibold dark:text-white">{{ $inquiry->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Email</p>
                        <p class="font-semibold">
                            <a href="mailto:{{ $inquiry->customer_email }}" class="text-red-600 dark:text-red-400 hover:underline">
                                {{ $inquiry->customer_email }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Phone</p>
                        <p class="font-semibold">
                            <a href="tel:{{ $inquiry->customer_phone }}" class="text-red-600 dark:text-red-400 hover:underline">
                                {{ $inquiry->customer_phone }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Inquiry Info -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 mb-6 transition-colors duration-300">
                <h3 class="text-lg font-bold mb-4 dark:text-white">Inquiry Details</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Source</p>
                        <p class="font-semibold dark:text-white">
                            @switch($inquiry->source)
                                @case('whatsapp')
                                    <i class="fab fa-whatsapp text-green-600 dark:text-green-400 mr-2"></i>WhatsApp
                                    @break
                                @case('phone')
                                    <i class="fas fa-phone text-blue-600 dark:text-blue-400 mr-2"></i>Phone
                                    @break
                                @default
                                    <i class="fas fa-envelope text-gray-600 dark:text-gray-400 mr-2"></i>Contact Form
                            @endswitch
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Status</p>
                        <p class="font-semibold">
                            @if($inquiry->is_read)
                                <span class="bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 px-3 py-1 rounded text-sm">✓ Read</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 px-3 py-1 rounded text-sm">● Unread</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Received</p>
                        <p class="font-semibold dark:text-white">{{ $inquiry->created_at->format('M d, Y \a\t H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 space-y-2 transition-colors duration-300">
                <a href="mailto:{{ $inquiry->customer_email }}?subject=Re:%20Your%20inquiry%20about%20{{ $inquiry->car->title }}" class="block w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition text-center">
                    <i class="fas fa-envelope mr-2"></i> Reply by Email
                </a>
                <a href="tel:{{ $inquiry->customer_phone }}" class="block w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition text-center">
                    <i class="fas fa-phone mr-2"></i> Call Customer
                </a>
                <a href="https://wa.me/{{ str_replace([' ', '-', '(', ')'], '', $inquiry->customer_phone) }}" target="_blank" class="block w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition text-center">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
