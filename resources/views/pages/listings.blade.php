@extends('layouts.app')

@section('title', 'Browse Cars - ThriftMotors')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ filtersOpen: false }">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold dark:text-white">Browse Cars</h1>
        <button @click="filtersOpen = !filtersOpen" class="lg:hidden bg-white dark:bg-gray-800 px-4 py-2 rounded-lg border dark:border-gray-700 shadow-sm text-sm font-semibold dark:text-white">
            <i class="fas fa-filter mr-2"></i> Filters
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Filters -->
        <aside class="lg:col-span-1" :class="filtersOpen ? 'block' : 'hidden lg:block'">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 sticky top-20 transition-colors duration-300">
                <h2 class="text-lg font-semibold mb-4 dark:text-white">Filter Results</h2>

                <form action="{{ route('cars.index') }}" method="GET" class="space-y-4">
                    <!-- Brand Filter -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Brand</label>
                        <select name="brand" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->slug }}" {{ request('brand') === $brand->slug ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fuel Type Filter -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Fuel Type</label>
                        <select name="fuel_type" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                            <option value="">All Types</option>
                            @foreach($fuelTypes as $fuel)
                                <option value="{{ $fuel->slug }}" {{ request('fuel_type') === $fuel->slug ? 'selected' : '' }}>
                                    {{ $fuel->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Transmission Filter -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Transmission</label>
                        <select name="transmission" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                            <option value="">All Types</option>
                            @foreach($transmissions as $trans)
                                <option value="{{ $trans->slug }}" {{ request('transmission') === $trans->slug ? 'selected' : '' }}>
                                    {{ $trans->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Min Price (KES)</label>
                        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Max Price (KES)</label>
                        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <!-- Year Range -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Min Year</label>
                        <input type="number" name="min_year" placeholder="Min Year" value="{{ request('min_year') }}" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Max Year</label>
                        <input type="number" name="max_year" placeholder="Max Year" value="{{ request('max_year') }}" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                        Apply Filters
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-3">
            <!-- Sort Options -->
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <p class="text-gray-600 dark:text-gray-400">
                    Showing <strong>{{ $cars->count() }}</strong> of <strong>{{ $cars->total() }}</strong> cars
                </p>
                <select name="sort" onchange="location.href='{{ route('cars.index') }}?sort=' + this.value + '&' + new URLSearchParams(window.location.search.slice(1)).toString()" class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest First</option>
                    <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                </select>
            </div>

            <!-- Cars Grid -->
            @if($cars->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    @foreach($cars as $car)
                        <x-car-card :car="$car" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $cars->links() }}
                </div>
            @else
                <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-12 text-center border border-transparent dark:border-gray-700">
                    <i class="fas fa-search text-5xl text-gray-400 dark:text-gray-500 mb-4 block"></i>
                    <p class="text-xl text-gray-600 dark:text-gray-300">No cars found matching your criteria.</p>
                    <a href="{{ route('cars.index') }}" class="inline-block mt-4 bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                        Clear Filters
                    </a>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
