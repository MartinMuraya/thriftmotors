@extends('layouts.admin')

@section('page-title', 'Edit Car')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-8 space-y-6 transition-colors duration-300">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="border-b dark:border-gray-700 pb-6">
            <h2 class="text-xl font-bold mb-4 dark:text-white">Basic Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-input 
                    name="title" 
                    label="Car Title" 
                    placeholder="e.g., 2020 Toyota Camry SE"
                    value="{{ $car->title }}"
                    required
                />

                <x-form-select 
                    name="brand_id" 
                    label="Brand"
                    :options="$brands->pluck('name', 'id')"
                    value="{{ $car->brand_id }}"
                    required
                />
            </div>

            <x-form-input 
                name="description" 
                label="Description" 
                type="textarea"
                placeholder="Detailed description of the car..."
                value="{{ $car->description }}"
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
                    value="{{ $car->year }}"
                    required
                />

                <x-form-input 
                    name="mileage" 
                    label="Mileage (km)" 
                    type="number"
                    placeholder="50000"
                    value="{{ $car->mileage }}"
                    required
                />

                <x-form-input 
                    name="color" 
                    label="Color" 
                    placeholder="Black"
                    value="{{ $car->color }}"
                    required
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form-select 
                    name="fuel_type_id" 
                    label="Fuel Type"
                    :options="$fuelTypes->pluck('name', 'id')"
                    value="{{ $car->fuel_type_id }}"
                    required
                />

                <x-form-select 
                    name="transmission_id" 
                    label="Transmission"
                    :options="$transmissions->pluck('name', 'id')"
                    value="{{ $car->transmission_id }}"
                    required
                />

                <x-form-input 
                    name="seats" 
                    label="Number of Seats" 
                    type="number"
                    placeholder="5"
                    value="{{ $car->seats }}"
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
                    value="{{ $car->price }}"
                    required
                />

                <div class="flex items-end">
                    <label class="flex items-center">
                        <input type="hidden" name="is_negotiable" value="0">
                        <input type="checkbox" name="is_negotiable" value="1" {{ $car->is_negotiable ? 'checked' : '' }} class="w-4 h-4 text-red-600 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 dark:text-gray-300">Price is Negotiable</span>
                    </label>
                    <label class="flex items-center ml-4">
                        <input type="hidden" name="is_for_hire" value="0">
                        <input type="checkbox" name="is_for_hire" value="1" {{ $car->is_for_hire ? 'checked' : '' }} class="w-4 h-4 text-red-600 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600">
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
                    value="{{ $car->seller_name }}"
                    required
                />

                <x-form-input 
                    name="seller_phone" 
                    label="Seller Phone" 
                    type="tel"
                    placeholder="+1234567890"
                    value="{{ $car->seller_phone }}"
                    required
                />

                <x-form-input 
                    name="seller_whatsapp" 
                    label="Seller WhatsApp (Optional)" 
                    type="tel"
                    placeholder="+1234567890"
                    value="{{ $car->seller_whatsapp }}"
                />
            </div>
        </div>

        <!-- Current Images -->
        @if($car->images->count() > 0)
            <div class="border-b dark:border-gray-700 pb-6">
                <h2 class="text-xl font-bold mb-4 dark:text-white">Current Images</h2>
                <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                    @foreach($car->images as $image)
                        <div class="relative">
                            <img src="{{ $image->image_url }}" alt="Car image" class="w-full h-24 object-cover rounded">
                            <form action="#" method="POST" class="absolute top-0 right-0" style="display:none;">
                                <!-- Image deletion would go here -->
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Add More Images -->
        <div class="border-b dark:border-gray-700 pb-6">
            <h2 class="text-xl font-bold mb-4 dark:text-white">Add More Images</h2>
            
            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
                    Upload Additional Images (optional)
                </label>
                <input 
                    type="file" 
                    name="images[]" 
                    multiple 
                    accept="image/*"
                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white"
                >
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Supported formats: JPEG, PNG, GIF. Max size: 5MB per image.</p>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex gap-4">
            <button type="submit" class="bg-red-600 text-white px-8 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                <i class="fas fa-save mr-2"></i> Update Listing
            </button>
            <a href="{{ route('admin.cars.index') }}" class="bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-300 px-8 py-2 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600 transition font-semibold">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
