@extends('layouts.app')

@section('title', 'ThriftMotors - Find Your Perfect Car')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-red-600 to-red-800 dark:from-red-900 dark:to-gray-900 text-white py-16 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Find Your Perfect Car
                </h1>
                <p class="text-xl mb-6 opacity-90">
                    Browse premium vehicles at unbeatable prices. Get in touch with sellers instantly via WhatsApp or phone.
                </p>
                <a href="{{ route('cars.index') }}" class="inline-block bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Browse Cars Now
                </a>
            </div>
            <div class="text-center">
                <i class="fas fa-car text-6xl opacity-50"></i>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-12">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-transparent dark:border-gray-700 p-8 transition-colors duration-300">
        <h2 class="text-2xl font-bold mb-6 dark:text-white">Search Cars</h2>
        <form action="{{ route('cars.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Brand</label>
                <select name="brand" class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    <option value="">All Brands</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->slug }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Price Range</label>
                <input type="number" name="min_price" placeholder="Min" class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">&nbsp;</label>
                <input type="number" name="max_price" placeholder="Max" class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Fuel Type</label>
                <select name="fuel_type" class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    <option value="">All Types</option>
                    @foreach($fuelTypes as $fuel)
                        <option value="{{ $fuel->slug }}">{{ $fuel->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">&nbsp;</label>
                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Featured Cars -->
@if($featuredCars->count() > 0)
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
    <h2 class="text-3xl font-bold mb-8 dark:text-white">⭐ Featured Listings</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($featuredCars as $car)
            <x-car-card :car="$car" />
        @endforeach
    </div>
</section>
@endif

<!-- Hot Deals -->
@if($hotDeals->count() > 0)
<section class="bg-gray-100 dark:bg-gray-800/50 py-16 mb-16 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-8 dark:text-white">🔥 Hot Deals</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($hotDeals as $car)
                <x-car-card :car="$car" />
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Recent Cars -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
    <h2 class="text-3xl font-bold mb-8 dark:text-white">Recently Added</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($recentCars as $car)
            <x-car-card :car="$car" />
        @endforeach
    </div>
    <div class="text-center mt-8">
        <a href="{{ route('cars.index') }}" class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition">
            View All Cars
        </a>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-red-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">{{ \App\Models\Car::where('is_active', true)->count() }}+</div>
                <p class="text-lg">Active Listings</p>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">{{ \App\Models\Brand::count() }}+</div>
                <p class="text-lg">Car Brands</p>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">{{ \App\Models\Inquiry::count() }}+</div>
                <p class="text-lg">Happy Customers</p>
            </div>
        </div>
    </div>
</section>
@endsection
