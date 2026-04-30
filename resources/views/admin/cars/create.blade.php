@extends('layouts.admin')

@section('page-title', 'Add New Car')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-8 space-y-6 transition-colors duration-300">
        @csrf

        <!-- Basic Information -->
        <div class="border-b dark:border-gray-700 pb-6">
            <h2 class="text-xl font-bold mb-4 dark:text-white">Basic Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-input 
                    name="title" 
                    label="Car Title" 
                    placeholder="e.g., 2020 Toyota Camry SE" 
                    required
                />

                <x-form-select 
                    name="brand_id" 
                    label="Brand" 
                    :options="$brands->pluck('name', 'id')" 
                    required
                />
            </div>

            <x-form-input 
                name="description" 
                label="Description" 
                type="textarea"
                placeholder="Detailed description of the car..." 
                required
            />
        </div>

        <!-- Specifications -->
        <div class="border-b dark:border-gray-700 pb-6">
            <h2 class="text-xl font-bold mb-4 dark:text-white">Specifications</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form-input 
                    name="year" 
                    label="Year" 
                    type="number"
                    placeholder="2020" 
                    required
                />

                <x-form-input 
                    name="mileage" 
                    label="Mileage (km)" 
                    type="number"
                    placeholder="50000" 
                    required
                />

                <x-form-input 
                    name="color" 
                    label="Color" 
                    placeholder="Black" 
                    required
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form-select 
                    name="fuel_type_id" 
                    label="Fuel Type" 
                    :options="$fuelTypes->pluck('name', 'id')" 
                    required
                />

                <x-form-select 
                    name="transmission_id" 
                    label="Transmission" 
                    :options="$transmissions->pluck('name', 'id')" 
                    required
                />

                <x-form-input 
                    name="seats" 
                    label="Number of Seats" 
                    type="number"
                    placeholder="5" 
                    required
                />
            </div>
        </div>

        <!-- Pricing -->
        <div class="border-b dark:border-gray-700 pb-6">
            <h2 class="text-xl font-bold mb-4 dark:text-white">Pricing</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-input 
                    name="price" 
                    label="Price (KES)" 
                    type="number"
                    step="0.01"
                    placeholder="0.00" 
                    required
                />

                <div class="flex items-end">
                    <label class="flex items-center">
                        <input type="hidden" name="is_negotiable" value="0">
                        <input type="checkbox" name="is_negotiable" value="1" class="w-4 h-4 text-red-600 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 dark:text-gray-300">Price is Negotiable</span>
                    </label>
                    <label class="flex items-center ml-4">
                        <input type="hidden" name="is_for_hire" value="0">
                        <input type="checkbox" name="is_for_hire" value="1" class="w-4 h-4 text-red-600 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 dark:text-gray-300">Is for Hire</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Seller Information -->
        <div class="border-b dark:border-gray-700 pb-6">
            <h2 class="text-xl font-bold mb-4 dark:text-white">Seller Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-input 
                    name="seller_name" 
                    label="Seller Name" 
                    placeholder="John Doe" 
                    required
                />

                <x-form-input 
                    name="seller_phone" 
                    label="Seller Phone" 
                    type="tel"
                    placeholder="+1234567890" 
                    required
                />

                <x-form-input 
                    name="seller_whatsapp" 
                    label="Seller WhatsApp (Optional)" 
                    type="tel"
                    placeholder="+1234567890"
                />
            </div>
        </div>

        <!-- Images -->
        <div class="border-b dark:border-gray-700 pb-6">
            <h2 class="text-xl font-bold mb-4 dark:text-white">Images</h2>
            
            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
                    Upload Images (minimum 1, maximum 10)
                    <span class="text-red-600">*</span>
                </label>
                <input 
                    type="file" 
                    name="images[]" 
                    multiple 
                    accept="image/*"
                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white"
                    required
                >
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Supported formats: JPEG, PNG, GIF. Max size: 5MB per image.</p>
                @error('images')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Submit -->
        <div class="flex gap-4">
            <button type="submit" class="bg-red-600 text-white px-8 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                <i class="fas fa-save mr-2"></i> Create Listing
            </button>
            <a href="{{ route('admin.cars.index') }}" class="bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-300 px-8 py-2 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600 transition font-semibold">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
