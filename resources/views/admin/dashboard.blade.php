@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Cars</p>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-500">{{ $totalCars }}</p>
                </div>
                <i class="fas fa-car text-5xl text-gray-200 dark:text-gray-700"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Active Cars</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-500">{{ $activeCars }}</p>
                </div>
                <i class="fas fa-check-circle text-5xl text-gray-200 dark:text-gray-700"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Inquiries</p>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-500">{{ $totalInquiries }}</p>
                </div>
                <i class="fas fa-envelope text-5xl text-gray-200 dark:text-gray-700"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Unread Inquiries</p>
                    <p class="text-3xl font-bold text-orange-600 dark:text-orange-500">{{ $unreadInquiries }}</p>
                </div>
                <i class="fas fa-bell text-5xl text-gray-200 dark:text-gray-700"></i>
            </div>
        </div>
    </div>

    <!-- Recent Cars -->
    <!-- Recent Cars -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-transparent dark:border-gray-700 transition-colors duration-300">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold dark:text-white">Recent Cars</h2>
            <a href="{{ route('admin.cars.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                <i class="fas fa-plus mr-2"></i> Add Car
            </a>
        </div>

        @if($recentCars->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b dark:border-gray-700">
                        <tr>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Car</th>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Brand</th>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Price</th>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Status</th>
                            <th class="text-left py-3 px-4 dark:text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentCars as $car)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        @if($car->images->count() > 0)
                                            <img src="{{ $car->images->first()->image_url }}" alt="" class="w-12 h-12 rounded object-cover mr-3">
                                        @endif
                                        <span class="dark:text-white">{{ $car->title }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 dark:text-gray-300">{{ $car->brand->name }}</td>
                                <td class="py-3 px-4 font-semibold dark:text-white">KES {{ number_format($car->price, 0) }}</td>
                                <td class="py-3 px-4">
                                    @if($car->is_active)
                                        <span class="bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 px-3 py-1 rounded text-sm">Active</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 px-3 py-1 rounded text-sm">Inactive</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('admin.cars.show', $car) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.cars.edit', $car) }}" class="text-yellow-600 hover:text-yellow-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Recent Inquiries -->
    <!-- Recent Inquiries -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold dark:text-white">Recent Inquiries</h2>
            <a href="{{ route('admin.inquiries.index') }}" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                View All
            </a>
        </div>

        @if($recentInquiries->count() > 0)
            <div class="space-y-3">
                @foreach($recentInquiries as $inquiry)
                    <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold dark:text-white">{{ $inquiry->customer_name }}</p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Interested in: {{ $inquiry->car->title }}</p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $inquiry->created_at->diffForHumans() }}</p>
                            </div>
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-semibold">
                                View <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
