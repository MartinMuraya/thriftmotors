@extends('layouts.admin')

@section('page-title', 'Manage Cars')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold dark:text-white">All Cars</h2>
        <a href="{{ route('admin.cars.create') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
            <i class="fas fa-plus mr-2"></i> Add New Car
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-transparent dark:border-gray-700 transition-colors duration-300">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700/50 border-b dark:border-gray-700">
                    <tr>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Image</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Title</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Brand</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Price</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Status</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Featured</th>
                        <th class="text-left py-3 px-6 dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700">
                    @foreach($cars as $car)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="py-3 px-6">
                                @if($car->images->count() > 0)
                                    <img src="{{ $car->images->first()->image_url }}" alt="" class="w-12 h-12 rounded object-cover">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-6">
                                <div>
                                    <p class="font-semibold dark:text-white">{{ $car->title }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $car->year }}</p>
                                </div>
                            </td>
                            <td class="py-3 px-6 dark:text-gray-300">{{ $car->brand->name }}</td>
                            <td class="py-3 px-6 font-semibold dark:text-white">KES {{ number_format($car->price, 0) }}</td>
                            <td class="py-3 px-6">
                                @if($car->is_active)
                                    <form action="{{ route('admin.cars.toggle-active', $car) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-block bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 px-3 py-1 rounded text-sm hover:bg-green-200 dark:hover:bg-green-900/50 transition">
                                            Active
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.cars.toggle-active', $car) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-block bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400 px-3 py-1 rounded text-sm hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                                            Inactive
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td class="py-3 px-6">
                                @if($car->is_hot_deal)
                                    <form action="{{ route('admin.cars.toggle-hot-deal', $car) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-block bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400 px-3 py-1 rounded text-sm hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                                            🔥 Hot Deal
                                        </button>
                                    </form>
                                @elseif($car->is_featured)
                                    <form action="{{ route('admin.cars.toggle-featured', $car) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-block bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400 px-3 py-1 rounded text-sm hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition">
                                            ⭐ Featured
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.cars.toggle-featured', $car) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 px-3 py-1 rounded text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                            Mark Featured
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.cars.show', $car) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.cars.edit', $car) }}" class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>
        {{ $cars->links() }}
    </div>
</div>
@endsection
