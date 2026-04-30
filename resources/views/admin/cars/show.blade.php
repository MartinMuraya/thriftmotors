@extends('layouts.admin')

@section('page-title', $car->title)

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold dark:text-white">{{ $car->title }}</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.cars.edit', $car) }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Basic Details -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Images -->
        <div class="md:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-transparent dark:border-gray-700 transition-colors duration-300">
                <div class="bg-gray-100 dark:bg-gray-900/50 p-4 text-center">
                    @if($car->images->count() > 0)
                        <img src="{{ $car->images->first()->image_url }}" alt="{{ $car->title }}" class="w-full max-h-96 object-cover">
                    @else
                        <div class="py-16">
                            <i class="fas fa-image text-gray-400 dark:text-gray-600 text-6xl"></i>
                        </div>
                    @endif
                </div>
                @if($car->images->count() > 1)
                    <div class="p-4 grid grid-cols-6 gap-2">
                        @foreach($car->images as $image)
                            <img src="{{ $image->image_url }}" alt="" class="w-full h-16 object-cover rounded cursor-pointer hover:opacity-70">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Status Cards -->
        <div class="space-y-4">
            <!-- Price Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
                <p class="text-gray-600 dark:text-gray-400 text-sm">Listed Price</p>
                <p class="text-3xl font-bold text-red-600 dark:text-red-500 mb-2">KES {{ number_format($car->price, 0) }}</p>
                @if($car->is_negotiable)
                    <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 px-3 py-1 rounded text-sm">✓ Negotiable</span>
                @endif
            </div>

            <!-- Status Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-3">Status</p>
                @if($car->is_active)
                    <form action="{{ route('admin.cars.toggle-active', $car) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="w-full block bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 px-3 py-2 rounded text-sm hover:bg-green-200 dark:hover:bg-green-900/50 transition">
                            ✓ Active - Click to Deactivate
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.cars.toggle-active', $car) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="w-full block bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 px-3 py-2 rounded text-sm hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                            ✗ Inactive - Click to Activate
                        </button>
                    </form>
                @endif
            </div>

            <!-- Featured Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-3">Featured Status</p>
                @if($car->is_hot_deal)
                    <form action="{{ route('admin.cars.toggle-hot-deal', $car) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full block bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 px-3 py-2 rounded text-sm hover:bg-red-200 dark:hover:bg-red-900/50 transition mb-2">
                            🔥 Hot Deal - Click to Remove
                        </button>
                    </form>
                @elseif($car->is_featured)
                    <form action="{{ route('admin.cars.toggle-featured', $car) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full block bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 px-3 py-2 rounded text-sm hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition mb-2">
                            ⭐ Featured - Click to Remove
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.cars.toggle-featured', $car) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 px-3 py-2 rounded text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            Mark as Featured
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Detailed Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-bold mb-4 dark:text-white">Specifications</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Brand:</span>
                    <span class="font-semibold dark:text-white">{{ $car->brand->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Year:</span>
                    <span class="font-semibold dark:text-white">{{ $car->year }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Mileage:</span>
                    <span class="font-semibold dark:text-white">{{ $car->mileage }} km</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Color:</span>
                    <span class="font-semibold dark:text-white">{{ $car->color }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Fuel Type:</span>
                    <span class="font-semibold dark:text-white">{{ $car->fuelType->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Transmission:</span>
                    <span class="font-semibold dark:text-white">{{ $car->transmission->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Seats:</span>
                    <span class="font-semibold dark:text-white">{{ $car->seats }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-bold mb-4 dark:text-white">Seller Information</h3>
            <div class="space-y-3">
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Name:</span>
                    <p class="font-semibold dark:text-white">{{ $car->seller_name }}</p>
                </div>
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Phone:</span>
                    <p class="font-semibold"><a href="tel:{{ $car->seller_phone }}" class="text-red-600 dark:text-red-400 hover:underline">{{ $car->seller_phone }}</a></p>
                </div>
                @if($car->seller_whatsapp)
                    <div>
                        <span class="text-gray-600 dark:text-gray-400">WhatsApp:</span>
                        <p class="font-semibold"><a href="https://wa.me/{{ str_replace([' ', '-', '(', ')'], '', $car->seller_whatsapp) }}" class="text-green-600 dark:text-green-400 hover:underline" target="_blank">{{ $car->seller_whatsapp }}</a></p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
        <h3 class="text-lg font-bold mb-4 dark:text-white">Description</h3>
        <p class="text-gray-700 dark:text-gray-300">{{ $car->description }}</p>
    </div>

    <!-- Inquiries -->
    @if($car->inquiries->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-bold mb-4 dark:text-white">Inquiries ({{ $car->inquiries->count() }})</h3>
            <div class="space-y-3">
                @foreach($car->inquiries as $inquiry)
                    <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold dark:text-white">{{ $inquiry->customer_name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $inquiry->customer_email }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $inquiry->customer_phone }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">{{ $inquiry->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                View <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
