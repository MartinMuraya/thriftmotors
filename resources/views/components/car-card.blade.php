@props(['car'])

<div class="bg-white dark:bg-gray-800 rounded-lg border border-transparent dark:border-gray-700 shadow-md overflow-hidden hover:shadow-lg dark:hover:shadow-red-900/20 transition group cursor-pointer">
    <!-- Image -->
    <div class="relative overflow-hidden bg-gray-200 dark:bg-gray-700 h-48">
        @if($car->images->count() > 0)
            <img src="{{ $car->images->first()->image_url }}" alt="{{ $car->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <i class="fas fa-image text-gray-400 dark:text-gray-500 text-4xl"></i>
            </div>
        @endif

        <!-- Badge -->
        @if($car->is_hot_deal)
            <span class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm">
                🔥 Hot Deal
            </span>
        @elseif($car->is_featured)
            <span class="absolute top-3 right-3 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm">
                ⭐ Featured
            </span>
        @endif
    </div>

    <!-- Content -->
    <div class="p-4">
        <h3 class="text-lg font-semibold mb-2 line-clamp-1 dark:text-white">{{ $car->title }}</h3>
        
        <div class="flex justify-between items-start mb-3">
            <div>
                <div class="text-xl font-bold text-red-600 dark:text-red-500 mb-1">
                    KES {{ number_format($car->price, 0) }}
                </div>
                @if($car->is_negotiable)
                    <p class="text-xs text-gray-500 dark:text-gray-400">Negotiable</p>
                @endif
            </div>
        </div>

        <!-- Specs -->
        <div class="grid grid-cols-3 gap-2 mb-4 text-sm border-t border-b border-gray-100 dark:border-gray-700 py-3">
            <div class="text-center">
                <p class="text-gray-500 dark:text-gray-400 mb-1"><i class="fas fa-calendar"></i></p>
                <p class="font-semibold dark:text-gray-200">{{ $car->year }}</p>
            </div>
            <div class="text-center border-l border-r border-gray-100 dark:border-gray-700">
                <p class="text-gray-500 dark:text-gray-400 mb-1"><i class="fas fa-tachometer-alt"></i></p>
                <p class="font-semibold dark:text-gray-200">{{ $car->mileage }}km</p>
            </div>
            <div class="text-center">
                <p class="text-gray-500 dark:text-gray-400 mb-1"><i class="fas fa-gas-pump"></i></p>
                <p class="font-semibold dark:text-gray-200">{{ $car->fuelType->name }}</p>
            </div>
        </div>

        <!-- Info -->
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            <i class="fas fa-sitemap mr-1"></i> {{ $car->transmission->name }}
        </p>

        <!-- CTA -->
        <div class="flex gap-2">
            <a href="{{ route('cars.show', $car->slug) }}" class="flex-1 bg-red-600 dark:bg-red-600 text-white py-2.5 rounded-lg hover:bg-red-700 dark:hover:bg-red-700 transition text-center text-sm font-semibold shadow-sm">
                View Details
            </a>
        </div>
    </div>
</div>
